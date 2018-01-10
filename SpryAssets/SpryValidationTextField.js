// SpryValidationTextField.js - version 0.38 - Spry Pre-Release 1.6.1
//
// Copyright (c) 2006. Adobe Systems Incorporated.
// All rights reserved.
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are met:
//
//   * Redistributions of source code must retain the above copyright notice,
//     this list of conditions and the following disclaimer.
//   * Redistributions in binary form must reproduce the above copyright notice,
//     this list of conditions and the following disclaimer in the documentation
//     and/or other materials provided with the distribution.
//   * Neither the name of Adobe Systems Incorporated nor the names of its
//     contributors may be used to endorse or promote products derived from this
//     software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
// AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
// LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
// CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
// SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
// CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
// POSSIBILITY OF SUCH DAMAGE.

(function() { // BeginSpryComponent

if (typeof Spry == "undefined") window.Spry = {}; if (!Spry.Widget) Spry.Widget = {};

Spry.Widget.BrowserSniff = function()
{
	var b = navigator.appName.toString();
	var up = navigator.platform.toString();
	var ua = navigator.userAgent.toString();

	this.mozilla = this.ie = this.opera = this.safari = false;
	var re_opera = /Opera.([0-9\.]*)/i;
	var re_msie = /MSIE.([0-9\.]*)/i;
	var re_gecko = /gecko/i;
	var re_safari = /(applewebkit|safari)\/([\d\.]*)/i;
	var r = false;

	if ( (r = ua.match(re_opera))) {
		this.opera = true;
		this.version = parseFloat(r[1]);
	} else if ( (r = ua.match(re_msie))) {
		this.ie = true;
		this.version = parseFloat(r[1]);
	} else if ( (r = ua.match(re_safari))) {
		this.safari = true;
		this.version = parseFloat(r[2]);
	} else if (ua.match(re_gecko)) {
		var re_gecko_version = /rv:\s*([0-9\.]+)/i;
		r = ua.match(re_gecko_version);
		this.mozilla = true;
		this.version = parseFloat(r[1]);
	}
	this.windows = this.mac = this.linux = false;

	this.Platform = ua.match(/windows/i) ? "windows" :
					(ua.match(/linux/i) ? "linux" :
					(ua.match(/mac/i) ? "mac" :
					ua.match(/unix/i)? "unix" : "unknown"));
	this[this.Platform] = true;
	this.v = this.version;

	if (this.safari && this.mac && this.mozilla) {
		this.mozilla = false;
	}
};

Spry.is = new Spry.Widget.BrowserSniff();

Spry.Widget.ValidationTextField = function(element, type, options)
{
	type = Spry.Widget.Utils.firstValid(type, "none");
	if (typeof type != 'string') {
		this.showError('The second parameter in the constructor should be the validation type, the options are the third parameter.');
		return;
	}
	if (typeof Spry.Widget.ValidationTextField.ValidationDescriptors[type] == 'undefined') {
		this.showError('Unknown validation type received as the second parameter.');
		return;
	}
	options = Spry.Widget.Utils.firstValid(options, {});
	this.type = type;
	if (!this.isBrowserSupported()) {
		//disable character masking and pattern behaviors for low level browsers
		options.useCharacterMasking = false;
	}
	this.init(element, options);

	//make sure we validate at least on submit
	var validateOn = ['submit'].concat(Spry.Widget.Utils.firstValid(this.options.validateOn, []));
	validateOn = validateOn.join(",");

	this.validateOn = 0;
	this.validateOn = this.validateOn | (validateOn.indexOf('submit') != -1 ? Spry.Widget.ValidationTextField.ONSUBMIT : 0);
	this.validateOn = this.validateOn | (validateOn.indexOf('blur') != -1 ? Spry.Widget.ValidationTextField.ONBLUR : 0);
	this.validateOn = this.validateOn | (validateOn.indexOf('change') != -1 ? Spry.Widget.ValidationTextField.ONCHANGE : 0);

	if (Spry.Widget.ValidationTextField.onloadDidFire)
		this.attachBehaviors();
	else
		Spry.Widget.ValidationTextField.loadQueue.push(this);
};

Spry.Widget.ValidationTextField.ONCHANGE = 1;
Spry.Widget.ValidationTextField.ONBLUR = 2;
Spry.Widget.ValidationTextField.ONSUBMIT = 4;

Spry.Widget.ValidationTextField.ERROR_REQUIRED = 1;
Spry.Widget.ValidationTextField.ERROR_FORMAT = 2;
Spry.Widget.ValidationTextField.ERROR_RANGE_MIN = 4;
Spry.Widget.ValidationTextField.ERROR_RANGE_MAX = 8;
Spry.Widget.ValidationTextField.ERROR_CHARS_MIN = 16;
Spry.Widget.ValidationTextField.ERROR_CHARS_MAX = 32;

/* validation parameters:
 *  - characterMasking : prevent typing of characters not matching an regular expression
 *  - regExpFilter : additional regular expression to disalow typing of characters 
 *		(like the "-" sign in the middle of the value); use for partial matching of the currently typed value;
 * 		the typed value must match regExpFilter at any moment
 *  - pattern : enforce character on each position inside a pattern (AX0?)
 *  - validation : function performing logic validation; return false if failed and the typedValue value on success
 *  - minValue, maxValue : range validation; check if typedValue inside the specified range
 *  - minChars, maxChars : value length validation; at least/at most number of characters
 * */
Spry.Widget.ValidationTextField.ValidationDescriptors = {
	'none': {
	},
	'custom': {
	},
	'integer': {
		characterMasking: /[\-\+\d]/,
		regExpFilter: /^[\-\+]?\d*$/,
		validation: function(value, options) {
			if (value == '' || value == '-' || value == '+') {
				return false;
			}
			var regExp = /^[\-\+]?\d*$/;
			if (!regExp.test(value)) {
				return false;
			}
			options = options || {allowNegative:false};
			var ret = parseInt(value, 10);
			if (!isNaN(ret)) {
				var allowNegative = true;
				if (typeof options.allowNegative != 'undefined' && options.allowNegative == false) {
					allowNegative = false;
				}
				if (!allowNegative && value < 0) {
					ret = false;
				}
			} else {
				ret = false;
			}
			return ret;
		}
	},
	'real': {
		characterMasking: /[\d\.,\-\+e]/i,
		regExpFilter: /^[\-\+]?\d(?:|\.,\d{0,2})|(?:|e{0,1}[\-\+]?\d{0,})$/i,
		validation: function (value, options) {
			var regExp = /^[\+\-]?[0-9]+([\.,][0-9]+)?([eE]{0,1}[\-\+]?[0-9]+)?$/;
			if (!regExp.test(value)) {
				return false;
			}
			var ret = parseFloat(value);
			if (isNaN(ret)) {
				ret = false;
			}
			return ret;
		}
	},
	'currency': {
		formats: {
			'dot_comma': {
				characterMasking: /[\d\.\,\-\+\$]/,
				regExpFilter: /^[\-\+]?(?:[\d\.]*)+(|\,\d{0,2})$/,
				validation: function(value, options) {
					var ret = false;
					//2 or no digits after the comma
					if (/^(\-|\+)?\d{1,3}(?:\.\d{3})*(?:\,\d{2}|)$/.test(value) || /^(\-|\+)?\d+(?:\,\d{2}|)$/.test(value)) {
						value = value.toString().replace(/\./gi, '').replace(/\,/, '.');
						ret = parseFloat(value);
					}
					return ret;
				}
			},
			'comma_dot': {
				characterMasking: /[\d\.\,\-\+\$]/,
				regExpFilter: /^[\-\+]?(?:[\d\,]*)+(|\.\d{0,2})$/,
				validation: function(value, options) {
					var ret = false;
					//2 or no digits after the comma
					if (/^(\-|\+)?\d{1,3}(?:\,\d{3})*(?:\.\d{2}|)$/.test(value) || /^(\-|\+)?\d+(?:\.\d{2}|)$/.test(value)) {
						value = value.toString().replace(/\,/gi, '');
						ret = parseFloat(value);
					}
					return ret;
				}
			}
		}
	},
	'email': {
		characterMasking: /[^\s]/,
		validation: function(value, options) {
			var rx = /^[\w\.-]+@[\w\.-]+\.\w+$/i;
			return rx.test(value);
		}
	},
	'date': {
		validation: function(value, options)  ~dulla^@204~ ~dulla^@204~ ([mdy]+)[\.\-\/\\\s]+([mdy]+)[\.\-\/\~dulla^@204~ $/i;
			var valueRegExp = this.dateV~dulla^@204~ ern;
			var formatGroups = options.f~dulla^@204~ ormatRegExp);
			var valueGroups = v~dulla^@204~ lueRegExp);
			if (formatGroups !== ~dulla^@204~ Groups !== null) {
				var dayIndex ~dulla^@204~ r monthIndex = -1;
				var yearIndex~dulla^@204~ or (var i=1; i<formatGroups.length; i~dulla^@204~ witch (formatGroups[i].toLowerCase())~dulla^@204~ e "dd":
							dayIndex = i;
						~dulla^@204~ 		case "mm":
							monthIndex = i;~dulla^@204~ ;
						case "yy":
						case "yyyy~dulla^@204~ arIndex = i;
							break;
					}
~dulla^@204~  (dayIndex != -1 && monthIndex != -1 ~dulla^@204~ != -1) {
					var maxDay = -1;
				~dulla^@204~  parseInt(valueGroups[dayIndex], 10);~dulla^@204~ eMonth = parseInt(valueGroups[monthIn~dulla^@204~ 				var theYear = parseInt(valueGroup~dulla^@204~  10);

					// Check month value to~dulla^@204~ ..12
					if (theMonth < 1 || theMon~dulla^@204~ 					return false;
					}
					
		~dulla^@204~ te the maxDay according to the curren~dulla^@204~ 	switch (theMonth) {
						case 1:	/~dulla^@204~ 				case 3: // March
						case 5: /~dulla^@204~ case 7: // July
						case 8: // Aug~dulla^@204~ se 10: // October
						case 12: // ~dulla^@204~ 				maxDay = 31;
							break;
				~dulla^@204~ April
						case 6: // June
						c~dulla^@204~ tember
						case 11: // November
	~dulla^@204~ = 30;
							break;
						case 2: /~dulla^@204~ 						if ((parseInt(theYear/4, 10) * ~dulla^@204~  && (theYear % 100 != 0 || theYear % ~dulla^@204~ 
								maxDay = 29;
							} else ~dulla^@204~ xDay = 28;
							}
							break;
~dulla^@204~ 		// Check day value to be between 1.~dulla^@204~ 	if (theDay < 1 || theDay > maxDay) {~dulla^@204~ n false;
					}
					
					// If s~dulla^@204~ 'll return the date object
					retu~dulla^@204~ theYear, theMonth - 1, theDay));   //~dulla^@204~ quires a month between 0 and 11
				~dulla^@204~ {
				return false;
			}
		}
	},~dulla^@204~ 		validation: function(value, options~dulla^@204~ :MM:SS T
			var formatRegExp = /([hm~dulla^@204~ 	var valueRegExp = /(\d+|AM?|PM?)/gi;~dulla^@204~ atGroups = options.format.match(forma~dulla^@204~ 	var valueGroups = value.match(valueR~dulla^@204~ /mast match and have same length
			~dulla^@204~ ups !== null && valueGroups !== null)~dulla^@204~ ormatGroups.length != valueGroups.len~dulla^@204~ return false;
				}

				var hourI~dulla^@204~ 			var minuteIndex = -1;
				var sec~dulla^@204~ ;
				//T is AM or PM
				var tInde~dulla^@204~ var theHour = 0, theMinute = 0, theSe~dulla^@204~ T = 'AM';
				for (var i=0; i<format~dulla^@204~ ; i++) {
					switch (formatGroups[i~dulla^@204~ ()) {
						case "hh":
							hourI~dulla^@204~ 					break;
						case "mm":
						~dulla^@204~ = i;
							break;
						case "ss":~dulla^@204~ ndIndex = i;
							break;
						ca~dulla^@204~ 		case "tt":
							tIndex = i;
			~dulla^@204~ 				}
				}
				if (hourIndex != -1~dulla^@204~  theHour = parseInt(valueGroups[hourI~dulla^@204~ 					if (isNaN(theHour) || theHour > ~dulla^@204~ [hourIndex] == 'HH' ? 23 : 12 )) {
	~dulla^@204~ alse;
					}
				}
				if (minuteI~dulla^@204~ 
					var theMinute = parseInt(value~dulla^@204~ Index], 10);
					if (isNaN(theMinut~dulla^@204~ te > 59) {
						return false;
				~dulla^@204~ 		if (secondIndex != -1) {
					var ~dulla^@204~ arseInt(valueGroups[secondIndex], 10)~dulla^@204~ sNaN(theSecond) || theSecond > 59) {~dulla^@204~  false;
					}
				}
				if (tInde~dulla^@204~ 				var theT = valueGroups[tIndex].to~dulla^@204~ 
					if (
						formatGroups[tIndex~dulla^@204~ () == 'TT' && !/^a|pm$/i.test(theT) |~dulla^@204~ matGroups[tIndex].toUpperCase() == 'T~dulla^@204~ i.test(theT)
					) {
						return ~dulla^@204~ }
				}
				var date = new Date(200~dulla^@204~ our + (theT.charAt(0) == 'P'?12:0), t~dulla^@204~ Second);
				return date;
			} else~dulla^@204~ n false;
			}
		}
	},
	'credit_ca~dulla^@204~ racterMasking: /\d/,
		validation: f~dulla^@204~ , options) {
			var regExp = null;
~dulla^@204~ rmat = options.format || 'ALL';
			s~dulla^@204~ s.format.toUpperCase()) {
				case '~dulla^@204~ = /^[3-6]{1}[0-9]{12,18}$/; break;
	~dulla^@204~ ': regExp = /^4(?:[0-9]{12}|[0-9]{15}~dulla^@204~ 				case 'MASTERCARD': regExp = /^5[1~dulla^@204~ 4}$/; break;
				case 'AMEX': regExp~dulla^@204~ }[0-9]{13}$/; break;
				case 'DISCO~dulla^@204~ = /^6011[0-9]{12}$/; break;
				case~dulla^@204~ : regExp = /^3(?:(0[0-5]{1}[0-9]{11})~dulla^@204~ |(8[0-9]{12}))$/; break;
			}
			if~dulla^@204~ t(value)) {
				return false;
			}~dulla^@204~ s = [];
			var j = 1, digit = '';
	~dulla^@204~ = value.length - 1; i >= 0; i--) {
	~dulla^@204~ == 0) {
					digit = parseInt(value.~dulla^@204~ ) * 2;
					digits[digits.length] = ~dulla^@204~ g().charAt(0);
					if (digit.toStri~dulla^@204~ = 2) {
						digits[digits.length] =~dulla^@204~ ng().charAt(1);
					}
				} else {~dulla^@204~ = value.charAt(i);
					digits[digit~dulla^@204~ igit;
				}
				j++;
			}
			var ~dulla^@204~ for(i=0; i < digits.length; i++ ) {
~dulla^@204~ rseInt(digits[i], 10);
			}
			if (~dulla^@204~ ) {
				return true;
			}
			retur~dulla^@204~ 
	},
	'zip_code': {
		formats: {
~dulla^@204~  {
				pattern:'00000-0000'
			},
~dulla^@204~  {
				pattern:'00000'
			},
			'z~dulla^@204~ 		characterMasking: /[\dA-Z\s]/,
			~dulla^@204~ function(value, options) {
					//ch~dulla^@204~ e following masks
					// AN NAA, AN~dulla^@204~ A, AAN NAA, AANA NAA, AANN NAA
					~dulla^@204~ ]{1,2}\d[\dA-Z]?\s?\d[A-Z]{2}$/.test(~dulla^@204~ }
			},
			'zip_canada': {
				cha~dulla^@204~ : /[\dA-Z\s]/,
				pattern: 'A0A 0A0~dulla^@204~ 'zip_custom': {}
		}
	},
	'phone_n~dulla^@204~ formats: {
			//US phone number; 10 ~dulla^@204~ hone_us': {
				pattern:'(000) 000-0~dulla^@204~ 			'phone_custom': {}
		}
	},
	'so~dulla^@204~ _number': {
		pattern:'000-00-0000'~dulla^@204~ {
		characterMaskingFormats: {
			'~dulla^@204~ ]/i,
			'ipv6_ipv4': /[\d\.\:A-F\/]/~dulla^@204~ : /[\d\.\:A-F\/]/i
		},
		validatio~dulla^@204~ value, options) {
			return Spry.Wid~dulla^@204~ nTextField.validateIP(value, options.~dulla^@204~ 
	},

	'url': {
		characterMaskin~dulla^@204~ 		validation: function(value, options~dulla^@204~  for ?ID=223429 and ?ID=223387
			/*~dulla^@204~ g regexp matches components of an URI~dulla^@204~  in http://tools.ietf.org/html/rfc398~dulla^@204~ e 51, Appendix B.
				scheme    = $2~dulla^@204~ ty = $4
				path      = $5
				quer~dulla^@204~ 			fragment  = $9
			*/
			var URI_~dulla^@204~ ([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]~dulla^@204~ ?(#(.*))?/;
			var parts = value.mat~dulla^@204~ r);
			if (parts && parts[4]) {
			~dulla^@204~ h component of the domain name using ~dulla^@204~ ding scheme: http://tools.ietf.org/ht~dulla^@204~ 			var host  = parts[4].split(".");
~dulla^@204~ ncoded = '';
				for (var i=0; i<hos~dulla^@204~ ) {
					punyencoded = Spry.Widget.U~dulla^@204~ _encode(host[i], 64);
					if (!puny~dulla^@204~ 					return false;
					} else {
		~dulla^@204~ ncoded != (host[i] + "-")) {
							~dulla^@204~ --' + punyencoded;
						}
					}
~dulla^@204~ st = host .join(".");
				//the enco~dulla^@204~ me is replaced into the original URL ~dulla^@204~ ed again later as URL
				value = va~dulla^@204~ RI_spliter, "$1//" + host + "$5$6$8")~dulla^@204~ 	//fix for ?ID=223358 and ?ID=223594~dulla^@204~ lowing validates an URL using ABNF ru~dulla^@204~ d in http://tools.ietf.org/html/rfc39~dulla^@204~  A., page 49
			//except host which ~dulla^@204~ by match[1] and validated separately~dulla^@204~  userinfo=	(?:(?:[a-z0-9\-\._~\!\$\&\~dulla^@204~ \=:]|%[0-9a-f]{2,2})*\@)?
			 * host~dulla^@204~ :[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9]~dulla^@204~ [a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]~dulla^@204~ pathname=	(?:\/(?:[a-z0-9\-\._~\!\$\&~dulla^@204~ ;\=\:\@]|%[0-9a-f]{2,2})*)*
			 * qu~dulla^@204~ ?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=~dulla^@204~ -9a-f]{2,2})*)?
			 * anchor=		(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@~dulla^@204~ f]{2,2})*)?
			 */
			var regExp = ~dulla^@204~ tp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\~dulla^@204~ :]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z~dulla^@204~ ]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0~dulla^@204~ ]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?~dulla^@204~ 0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|~dulla^@204~ })*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\~dulla^@204~ \@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-~dulla^@204~ $\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f~dulla^@204~ ;

			var valid = value.match(regEx~dulla^@204~ alid) {
				//extract the  address f~dulla^@204~ var address = valid[1];

				if (ad~dulla^@204~ 		if (address == '[]') {
						retur~dulla^@204~ 		}
					if (address.charAt(0) == '[~dulla^@204~ //IPv6 address or IPv4 enclosed in sq~dulla^@204~ 
						address = address.replace(/^\~dulla^@204~ ;
						return Spry.Widget.Validatio~dulla^@204~ lidateIP(address, 'ipv6_ipv4');
				~dulla^@204~ 				if (/[^0-9\.]/.test(address)) {
~dulla^@204~  true;
						} else {
							//chec~dulla^@204~  is all digits and dots and then chec~dulla^@204~ 						return Spry.Widget.ValidationTe~dulla^@204~ ateIP(address, 'ipv4');
						}
			~dulla^@204~ se {
					return true;
				}
			} ~dulla^@204~ eturn false;
			}
		}
	}
};

/*~dulla^@204~ erred
x:x:x:x:x:x:x:x, where the 'x'~dulla^@204~ adecimal values of the eight 16-bit p~dulla^@204~ address.
Examples:
	FEDC:BA98:7654:~dulla^@204~ 8:7654:3210
	1080:0:0:0:8:800:200C:4~dulla^@204~ t it is not necessary to write the le~dulla^@204~ n an
individual field, but there mus~dulla^@204~  one numeral in every
field (except ~dulla^@204~ described in 2.2.2.).

2.2.2. Compr~dulla^@204~ e of "::" indicates multiple groups o~dulla^@204~ zeros.
The "::" can only appear once~dulla^@204~ s.  The "::" can also be
used to com~dulla^@204~ ding and/or trailing zeros in an addr~dulla^@204~ :0:0:8:800:200C:417A --> 1080::8:800:~dulla^@204~ F01:0:0:0:0:0:0:101 --> FF01::101
	0~dulla^@204~ 1 --> ::1
	0:0:0:0:0:0:0:0 --> ::
~dulla^@204~ ddresses with Embedded IPv4 Addresses~dulla^@204~ tible IPv6 address (tunnel IPv6 packe~dulla^@204~ routing infrastructures)
	::0:129.14~dulla^@204~ 4-mapped IPv6 address (represent the ~dulla^@204~ IPv4-only nodes as IPv6 addresses)
	~dulla^@204~ 4.52.38

The text representation of~dulla^@204~ es and prefixes in Augmented BNF (Bac~dulla^@204~ ) [ABNF] for reference purposes.
[AB~dulla^@204~ ls.ietf.org/html/rfc2234]
      IPv6~dulla^@204~ part [ ":" IPv4address ]
      IPv4a~dulla^@204~ IGIT "." 1*3DIGIT "." 1*3DIGIT "." 1*~dulla^@204~    IPv6prefix  = hexpart "/" 1*2DIGIT~dulla^@204~ part = hexseq | hexseq "::" [ hexseq ~dulla^@204~ xseq ]
      hexseq  = hex4 *( ":" h~dulla^@204~ ex4    = 1*4HEXDIG
*/
Spry.Widget.V~dulla^@204~ Field.validateIP = function (value, f~dulla^@204~ ar validIPv6Addresses = [
		//prefer~dulla^@204~ a-f0-9]{1,4}:){7}[a-f0-9]{1,4}(?:\/\d~dulla^@204~ 
		//various compressed
		/^[a-f0-9~dulla^@204~ \d{1,3})?$/i,
		/^:(?::[a-f0-9]{1,4}~dulla^@204~ {1,3})?$/i,
		/^(?:[a-f0-9]{1,4}:){1~dulla^@204~ ,3})?$/i,
		/^(?:[a-f0-9]{1,4}:)(?::~dulla^@204~ ){1,6}(?:\/\d{1,3})?$/i,
		/^(?:[a-f~dulla^@204~ }(?::[a-f0-9]{1,4}){1,5}(?:\/\d{1,3})~dulla^@204~ :[a-f0-9]{1,4}:){3}(?::[a-f0-9]{1,4})~dulla^@204~ 1,3})?$/i,
		/^(?:[a-f0-9]{1,4}:){4}~dulla^@204~ 1,4}){1,3}(?:\/\d{1,3})?$/i,
		/^(?:~dulla^@204~ :){5}(?::[a-f0-9]{1,4}){1,2}(?:\/\d{1~dulla^@204~ /^(?:[a-f0-9]{1,4}:){6}(?::[a-f0-9]{1~dulla^@204~ ,3})?$/i,


		//IPv6 mixes with IP~dulla^@204~ -f0-9]{1,4}:){6}(?:\d{1,3}\.){3}\d{1,~dulla^@204~ })?$/i,
		/^:(?::[a-f0-9]{1,4}){0,4}~dulla^@204~ ){3}\d{1,3}(?:\/\d{1,3})?$/i,
		/^(?~dulla^@204~ }:){1,5}:(?:\d{1,3}\.){3}\d{1,3}(?:\/~dulla^@204~ 
		/^(?:[a-f0-9]{1,4}:)(?::[a-f0-9]{~dulla^@204~ :\d{1,3}\.){3}\d{1,3}(?:\/\d{1,3})?$/~dulla^@204~ -f0-9]{1,4}:){2}(?::[a-f0-9]{1,4}){1,~dulla^@204~ \.){3}\d{1,3}(?:\/\d{1,3})?$/i,	
		/~dulla^@204~ 1,4}:){3}(?::[a-f0-9]{1,4}){1,2}:(?:\~dulla^@204~ d{1,3}(?:\/\d{1,3})?$/i,
		/^(?:[a-f~dulla^@204~ }(?::[a-f0-9]{1,4}):(?:\d{1,3}\.){3}\~dulla^@204~ {1,3})?$/i
	];
	var validIPv4Addres~dulla^@204~ IPv4
		/^(\d{1,3}\.){3}\d{1,3}$/i
	~dulla^@204~ dAddresses = [];
	if (format == 'ipv~dulla^@204~ == 'ipv6_ipv4') {
		validAddresses =~dulla^@204~ es.concat(validIPv6Addresses);
	}
	~dulla^@204~  'ipv4' || format == 'ipv6_ipv4') {
~dulla^@204~ ses = validAddresses.concat(validIPv4~dulla^@204~ 	}

	var ret = false;
	for (var i=~dulla^@204~ resses.length; i++) {
		if (validAdd~dulla^@204~ t(value)) {
			ret = true;
			break~dulla^@204~ 
	if (ret && value.indexOf(".") != -1~dulla^@204~ ddress contains IPv4 fragment, it mus~dulla^@204~ ll 4 groups must be less than 256
		~dulla^@204~ lue.match(/:?(?:\d{1,3}\.){3}\d{1,3}/~dulla^@204~ v4) {
			return false;
		}
		ipv4 ~dulla^@204~ lace(/^:/, '');
		var pieces = ipv4.~dulla^@204~ 		if (pieces.length != 4) {
			retur~dulla^@204~ 
		var regExp = /^[\-\+]?\d*$/;
		f~dulla^@204~ i< pieces.length; i++) {
			if (piec~dulla^@204~ {
				return false;
			}
			var pi~dulla^@204~ t(pieces[i], 10);
			if (isNaN(piece~dulla^@204~ 255 || !regExp.test(pieces[i]) || pie~dulla^@204~ >3 || /^0{2,3}$/.test(pieces[i])) {
~dulla^@204~ lse;
			}
		}
	}
	if (ret && valu~dulla^@204~ ) != -1) {
		// if prefix-length is ~dulla^@204~ t be in [1-128]
		var prefLen = valu~dulla^@204~ {1,3}$/);
		if (!prefLen) return fal~dulla^@204~ efLenVal = parseInt(prefLen[0].replac~dulla^@204~ 10);
		if (isNaN(prefLenVal) || pref~dulla^@204~ || prefLenVal < 1) {
			return false~dulla^@204~ return ret;
};

Spry.Widget.Valida~dulla^@204~ .onloadDidFire = false;
Spry.Widget.~dulla^@204~ tField.loadQueue = [];

Spry.Widget~dulla^@204~ xtField.prototype.isBrowserSupported ~dulla^@204~ 
{
	return Spry.is.ie && Spry.is.v >~dulla^@204~ s.windows
		||
	Spry.is.mozilla && ~dulla^@204~ 1.4
		||
	Spry.is.safari
		||
	Sp~dulla^@204~ & Spry.is.v >= 9;
};

Spry.Widget.~dulla^@204~ tField.prototype.init = function(elem~dulla^@204~ 
{
	this.element = this.getElement(~dulla^@204~ his.errors = 0;
	this.flags = {locke~dulla^@204~ toreSelection: true};
	this.options ~dulla^@204~ event_handlers = [];

	this.validCl~dulla^@204~ eldValidState";
	this.focusClass = "~dulla^@204~ sState";
	this.requiredClass = "text~dulla^@204~ State";
	this.hintClass = "textfield~dulla^@204~ 	this.invalidFormatClass = "textfield~dulla^@204~ State";
	this.invalidRangeMinClass =~dulla^@204~ nValueState";
	this.invalidRangeMaxC~dulla^@204~ ieldMaxValueState";
	this.invalidCha~dulla^@204~ "textfieldMinCharsState";
	this.inva~dulla^@204~ ass = "textfieldMaxCharsState";
	thi~dulla^@204~ ashTextClass = "textfieldFlashText";~dulla^@204~ .safari) {
		this.flags.lastKeyPress~dulla^@204~  0;
	}

	switch (this.type) {
		c~dulla^@204~ mber':options.format = Spry.Widget.Ut~dulla^@204~ d(options.format, 'phone_us');break;~dulla^@204~ ency':options.format = Spry.Widget.Ut~dulla^@204~ d(options.format, 'comma_dot');break;~dulla^@204~ _code':options.format = Spry.Widget.U~dulla^@204~ id(options.format, 'zip_us5');break;~dulla^@204~ ':
			options.format = Spry.Widget.U~dulla^@204~ id(options.format, 'mm/dd/yy');
			b~dulla^@204~  'time':
			options.format = Spry.Wi~dulla^@204~ rstValid(options.format, 'HH:mm');
	~dulla^@204~ tern = options.format.replace(/[hms]/~dulla^@204~ ace(/TT/gi, 'AM').replace(/T/gi, 'A')~dulla^@204~ 
		case 'ip':
			options.format = Sp~dulla^@204~ ls.firstValid(options.format, 'ipv4')~dulla^@204~ .characterMasking = Spry.Widget.Valid~dulla^@204~ d.ValidationDescriptors[this.type].ch~dulla^@204~ gFormats[options.format]; 
			break;~dulla^@204~ trieve the validation type descriptor~dulla^@204~ ith this instance (base on type and f~dulla^@204~ dgets may have different validations ~dulla^@204~ format (like zip_code with formats)
~dulla^@204~ onDescriptor = {};
	if (options.form~dulla^@204~ dget.ValidationTextField.ValidationDe~dulla^@204~ s.type].formats) {
		if (Spry.Widget~dulla^@204~ xtField.ValidationDescriptors[this.ty~dulla^@204~ ptions.format]) {
			Spry.Widget.Uti~dulla^@204~ (validationDescriptor, Spry.Widget.ValidationTextField.ValidationDescriptors[th~dulla^@204~ ats[options.format]);
		}
	} else {~dulla^@204~ et.Utils.setOptions(validationDescrip~dulla^@204~ get.ValidationTextField.ValidationDes~dulla^@204~ .type]);
	}

	//set default values~dulla^@204~ ameters which were not aspecified
	o~dulla^@204~ racterMasking = Spry.Widget.Utils.fir~dulla^@204~ ns.useCharacterMasking, false);
	opt~dulla^@204~ pry.Widget.Utils.firstValid(options.h~dulla^@204~ ptions.isRequired = Spry.Widget.Utils~dulla^@204~ ptions.isRequired, true);
	options.a~dulla^@204~ r = Spry.Widget.Utils.firstValid(opti~dulla^@204~ lError, false);
	if (options.additio~dulla^@204~ options.additionalError = this.getEle~dulla^@204~ additionalError);

	//set widget va~dulla^@204~ meters
	//get values from validation~dulla^@204~ tor
	//use the user specified values~dulla^@204~ 
	options.characterMasking = Spry.Wid~dulla^@204~ stValid(options.characterMasking, val~dulla^@204~ ptor.characterMasking);
	options.reg~dulla^@204~ pry.Widget.Utils.firstValid(options.r~dulla^@204~ validationDescriptor.regExpFilter);
~dulla^@204~ ern = Spry.Widget.Utils.firstValid(op~dulla^@204~ , validationDescriptor.pattern);
	op~dulla^@204~ ion = Spry.Widget.Utils.firstValid(op~dulla^@204~ ion, validationDescriptor.validation)~dulla^@204~ f options.validation == 'string') {
~dulla^@204~ idation = eval(options.validation);
~dulla^@204~ s.minValue = Spry.Widget.Utils.firstV~dulla^@204~ minValue, validationDescriptor.minVal~dulla^@204~ s.maxValue = Spry.Widget.Utils.firstV~dulla^@204~ maxValue, validationDescriptor.maxVal~dulla^@204~ ons.minChars = Spry.Widget.Utils.firs~dulla^@204~ s.minChars, validationDescriptor.minC~dulla^@204~ ons.maxChars = Spry.Widget.Utils.firs~dulla^@204~ s.maxChars, validationDescriptor.maxC~dulla^@204~ ry.Widget.Utils.setOptions(this, opti~dulla^@204~ Widget.Utils.setOptions(this.options,~dulla^@204~ ;

Spry.Widget.ValidationTextField.~dulla^@204~ troy = function() {
	if (this.event_~dulla^@204~ for (var i=0; i<this.event_handlers.l~dulla^@204~ 
			Spry.Widget.Utils.removeEventLis~dulla^@204~ ent_handlers[i][0], this.event_handle~dulla^@204~ s.event_handlers[i][2], false);
		}~dulla^@204~ e this.element; } catch(err) {}
	try~dulla^@204~ s.input; } catch(err) {}
	try { dele~dulla^@204~  } catch(err) {}
	try { delete this.~dulla^@204~ s; } catch(err) {}
	try { this.selec~dulla^@204~ ); } catch(err) {}
	try { delete thi~dulla^@204~ } catch(err) {}

	var q = Spry.Widg~dulla^@204~ mitWidgetQueue;
	var qlen = q.length~dulla^@204~ i = 0; i < qlen; i++) {
		if (q[i] =~dulla^@204~ 	q.splice(i, 1);
			break;
		}
	}~dulla^@204~ idget.ValidationTextField.prototype.a~dulla^@204~ s = function()
{
	if (this.element)~dulla^@204~ s.element.nodeName == "INPUT") {
			~dulla^@204~ this.element;
		} else {
			this.in~dulla^@204~ dget.Utils.getFirstChildWithNodeNameA~dulla^@204~ s.element, "INPUT");
		}
	}

	if ~dulla^@204~ {
		if (this.maxChars) {
			this.in~dulla^@204~ ribute("maxLength");
		}
		this.put~dulla^@204~ is.compilePattern();
		if (this.type~dulla^@204~ 
			this.compileDatePattern();
		}~dulla^@204~ .setAttribute("AutoComplete", "off");~dulla^@204~ ction = new Spry.Widget.SelectionDesc~dulla^@204~ nput);
		this.oldValue = this.input.~dulla^@204~ ar self = this;
		this.event_handler~dulla^@204~ this.event_handlers.push([this.input,~dulla^@204~ unction(e) { if (self.isDisabled()) r~dulla^@204~ eturn self.onKeyDown(e || event); }])~dulla^@204~ nt_handlers.push([this.input, "keypre~dulla^@204~ (e) { if (self.isDisabled()) return t~dulla^@204~ elf.onKeyPress(e || event); }]);
		i~dulla^@204~ era) {
			this.event_handlers.push([~dulla^@204~ keyup", function(e) { if (self.isDisa~dulla^@204~ n true; return self.onKeyUp(e || even~dulla^@204~ 

		this.event_handlers.push([this.~dulla^@204~ ", function(e) { if (self.isDisabled(~dulla^@204~ e; return self.onFocus(e || event); }~dulla^@204~ vent_handlers.push([this.input, "blur~dulla^@204~ ) { if (self.isDisabled()) return tru~dulla^@204~ f.onBlur(e || event); }]);

		this.~dulla^@204~ s.push([this.input, "mousedown", func~dulla^@204~ (self.isDisabled()) return true; retu~dulla^@204~ seDown(e || event); }]);

		var cha~dulla^@204~ 			Spry.is.mozilla || Spry.is.opera |~dulla^@204~ ari?"input":
			Spry.is.ie?"property~dulla^@204~ "change";
		this.event_handlers.push~dulla^@204~  changeEvent, function(e) { if (self.~dulla^@204~  return true; return self.onChange(e ~dulla^@204~ );

		if (Spry.is.mozilla || Spry.i~dulla^@204~ 			//oninput event on mozilla does no~dulla^@204~ drop
			this.event_handlers.push([th~dulla^@204~ agdrop", function(e) { if (self.isDis~dulla^@204~ rn true; self.removeHint();return sel~dulla^@204~ || event); }]);
		} else if (Spry.is~dulla^@204~ ndrop&onpropertychange crash on IE 
~dulla^@204~ _handlers.push([this.input, "drop", f~dulla^@204~ if (self.isDisabled()) return true; r~dulla^@204~ Drop(e || event); }]);
		}

		for ~dulla^@204~ his.event_handlers.length; i++) {
		~dulla^@204~ Utils.addEventListener(this.event_han~dulla^@204~ this.event_handlers[i][1], this.event~dulla^@204~ 2], false);
		}

		// submit
		th~dulla^@204~ y.Widget.Utils.getFirstParentWithNode~dulla^@204~ ut, "FORM");
		if (this.form) {
			~dulla^@204~ ubmit" handler has been attached to t~dulla^@204~ rm, attach one
			if (!this.form.att~dulla^@204~ ndler && !this.form.onsubmit) {
				~dulla^@204~ ubmit = function(e) { e = e || event;~dulla^@204~ Widget.Form.onSubmit(e, e.srcElement ~dulla^@204~ arget) };
				this.form.attachedSubm~dulla^@204~ rue;                 
			}
			if (!~dulla^@204~ achedResetHandler) {
				Spry.Widget~dulla^@204~ ntListener(this.form, "reset", functi~dulla^@204~  || event; return Spry.Widget.Form.on~dulla^@204~ cElement || e.currentTarget) }, false~dulla^@204~ form.attachedResetHandler = true;    ~dulla^@204~ 
			}
			// add the currrent widget~dulla^@204~ bmit" check queue;
			Spry.Widget.Fo~dulla^@204~ dgetQueue.push(this);
		}
	}	
};
~dulla^@204~ .ValidationTextField.prototype.isDisa~dulla^@204~ on() {
	return this.input && (this.i~dulla^@204~  || this.input.readOnly) || !this.inp~dulla^@204~ ry.Widget.ValidationTextField.prototy~dulla^@204~  = function(ele)
{
	if (ele && type~dulla^@204~ ring")
		return document.getElementB~dulla^@204~ eturn ele;
};

Spry.Widget.Validat~dulla^@204~ addLoadListener = function(handler)
~dulla^@204~ f window.addEventListener != 'undefin~dulla^@204~ w.addEventListener('load', handler, f~dulla^@204~  if (typeof document.addEventListener~dulla^@204~ d')
		document.addEventListener('loa~dulla^@204~ false);
	else if (typeof window.atta~dulla^@204~ ndefined')
		window.attachEvent('onl~dulla^@204~ );
};

Spry.Widget.ValidationTextF~dulla^@204~ oadQueue = function(handler)
{
	Spr~dulla^@204~ dationTextField.onloadDidFire = true;~dulla^@204~ ry.Widget.ValidationTextField.loadQue~dulla^@204~ n = q.length;
	for (var i = 0; i < q~dulla^@204~ q[i].attachBehaviors();
};

Spry.W~dulla^@204~ ionTextField.addLoadListener(Spry.Wid~dulla^@204~ nTextField.processLoadQueue);
Spry.W~dulla^@204~ ionTextField.addLoadListener(function~dulla^@204~ dget.Utils.addEventListener(window, "~dulla^@204~ .Widget.Form.destroyAll, false);
});~dulla^@204~ et.ValidationTextField.prototype.setV~dulla^@204~ on(newValue) {
	this.flags.locked = ~dulla^@204~ input.value = newValue;
	this.flags.~dulla^@204~ e;
	this.oldValue = newValue;
	if (~dulla^@204~ {
		this.onChange();
	}
};

/**~dulla^@204~ state of the input (selection and val~dulla^@204~  revert to it
 * should call this ju~dulla^@204~ ifying the input value
 */
Spry.Wid~dulla^@204~ nTextField.prototype.saveState = func~dulla^@204~ his.oldValue = this.input.value;
	th~dulla^@204~ update();
};

Spry.Widget.Validati~dulla^@204~ rototype.revertState = function(rever~dulla^@204~ if (revertValue != this.input.value) ~dulla^@204~ ut.readOnly = true;
		this.input.val~dulla^@204~ lue;
		this.input.readOnly = false;~dulla^@204~ s.safari && this.flags.active) {
			~dulla^@204~ cus();
		}
	}
  if (this.flags.res~dulla^@204~ ) {
	this.selection.moveTo(this.selection.start, this.selection.end);
  }

~dulla^@204~ Flash();
};

Spry.Widget.Validatio~dulla^@204~ ototype.removeHint = function()
{
	~dulla^@204~ s.hintOn) {
		this.input.value = "";~dulla^@204~ s.hintOn = false;
		this.removeClass~dulla^@204~ ment, this.hintClass);
		this.remove~dulla^@204~ s.additionalError, this.hintClass);
~dulla^@204~ y.Widget.ValidationTextField.prototyp~dulla^@204~ unction()
{
	if(this.hint && this.i~dulla^@204~ input.type == "text" && this.input.va~dulla^@204~ 
		this.flags.hintOn = true;
		this.~dulla^@204~  this.hint;
		this.addClassName(this~dulla^@204~ s.hintClass);
		this.addClassName(th~dulla^@204~ Error, this.hintClass);
	}
};

Sp~dulla^@204~ idationTextField.prototype.redTextFla~dulla^@204~ ()
{
	var self = this;
	this.addCl~dulla^@204~ element, this.textfieldFlashTextClass~dulla^@204~ ut(function() {
		self.removeClassNa~dulla^@204~ nt, self.textfieldFlashTextClass)
	}~dulla^@204~ 
Spry.Widget.ValidationTextField.pro~dulla^@204~ dations = function(testValue, revertV~dulla^@204~  (this.isDisabled()) return false;
~dulla^@204~ ags.locked) {
		return false;
	}
~dulla^@204~ ue.length == 0 && !this.isRequired) {~dulla^@204~ rs = 0;
		return false;
	}
	this.f~dulla^@204~  true;

	var mustRevert = false;
	~dulla^@204~ alidations = true;
	if (!this.option~dulla^@204~ && testValue.length == 0) {
		contin~dulla^@204~  = false;
	}

	var errors = 0;
	v~dulla^@204~  = testValue;

	//characterMasking ~dulla^@204~  characters are valid with the charac~dulla^@204~ eyboard filter)
	if (this.useCharact~dulla^@204~ this.characterMasking) {
		for(var i~dulla^@204~ ue.length; i++) {
			if (!this.chara~dulla^@204~ est(testValue.charAt(i))) {
				erro~dulla^@204~  Spry.Widget.ValidationTextField.ERRO~dulla^@204~ 		fixedValue = revertValue;
				must~dulla^@204~ ;
				break;
			}
		}
	}

	//re~dulla^@204~ character mask positioning (additiona~dulla^@204~ trict some characters only in some po~dulla^@204~ (!mustRevert && this.useCharacterMask~dulla^@204~ egExpFilter) {
		if (!this.regExpFil~dulla^@204~ dValue)) {
			errors = errors | Spry~dulla^@204~ ationTextField.ERROR_FORMAT;
			must~dulla^@204~ ;
		}
	}

	//pattern - testValue ~dulla^@204~ attern so far
	if (!mustRevert && th~dulla^@204~ 
		var currentRegExp = this.patternT~dulla^@204~ alue.length);
		if (!currentRegExp.t~dulla^@204~ )) {
			errors = errors | Spry.Widge~dulla^@204~ extField.ERROR_FORMAT;
			mustRevert~dulla^@204~  else if (this.patternLength != testV~dulla^@204~ {
			//testValue matches pattern so ~dulla^@204~  not ok if it does not have the prope~dulla^@204~ //do not revert, but should show the ~dulla^@204~ ors = errors | Spry.Widget.Validation~dulla^@204~ OR_FORMAT;
		}
	}

	if (fixedValu~dulla^@204~ 	errors = errors | Spry.Widget.Valida~dulla^@204~ .ERROR_REQUIRED;
	}

	if (!mustRev~dulla^@204~ attern && this.useCharacterMasking) {~dulla^@204~ his.getAutoComplete(testValue.length)~dulla^@204~ 
			fixedValue += n;
		}
	}

	if~dulla^@204~ && this.minChars !== null  && continu~dulla^@204~  {
		if (testValue.length < this.min~dulla^@204~ errors = errors | Spry.Widget.Validat~dulla^@204~ ERROR_CHARS_MIN;
			continueValidati~dulla^@204~ 
		}
	}

	if(!mustRevert && this.m~dulla^@204~ ull && continueValidations) {
		if (~dulla^@204~ gth > this.maxChars) {
			errors = e~dulla^@204~ Widget.ValidationTextField.ERROR_CHAR~dulla^@204~ ntinueValidations = false;
		}
	}
~dulla^@204~ on - testValue passes widget validati~dulla^@204~ 	if (!mustRevert && this.validation &~dulla^@204~ idations) {
		var value = this.valid~dulla^@204~ lue, this.options);
		if (false === ~dulla^@204~ errors = errors | Spry.Widget.Validat~dulla^@204~ ERROR_FORMAT;
			continueValidations~dulla^@204~ } else {
			this.typedValue = value;~dulla^@204~ 	if(!mustRevert && this.validation &&~dulla^@204~ e !== null && continueValidations) {~dulla^@204~ ue = this.validation(this.minValue.to~dulla^@204~ s.options);
		if (minValue !== false~dulla^@204~ his.typedValue < minValue) {
				err~dulla^@204~ | Spry.Widget.ValidationTextField.ERR~dulla^@204~ 
				continueValidations = false;
	~dulla^@204~ 

	if(!mustRevert && this.validation~dulla^@204~ alue !== null && continueValidations)~dulla^@204~ Value = this.validation(this.maxValue~dulla^@204~ this.options);
		if (maxValue !== fa~dulla^@204~ ( this.typedValue > maxValue) {
				~dulla^@204~ rs | Spry.Widget.ValidationTextField.~dulla^@204~ AX;
				continueValidations = false;~dulla^@204~ 	}

	//an invalid value was tested;~dulla^@204~ re it does not get inside the input
~dulla^@204~ CharacterMasking && mustRevert) {
		~dulla^@204~ ate(revertValue);
	}

	this.errors~dulla^@204~ this.fixedValue = fixedValue;

	thi~dulla^@204~ d = false;

	return mustRevert;
};~dulla^@204~ et.ValidationTextField.prototype.onCh~dulla^@204~ on(e)
{
	if (Spry.is.opera && this.~dulla^@204~ vertOnKeyUp) {
		return true;
	}
	~dulla^@204~ e && e && e.propertyName != 'value') ~dulla^@204~ rue;
	}

	if (this.flags.drop) {
~dulla^@204~ s if it's a drop operation
		var sel~dulla^@204~ setTimeout(function() {
			self.flag~dulla^@204~ e;
			self.onChange(null);
		}, 0);~dulla^@204~ 	}

	if (this.flags.hintOn) {
		re~dulla^@204~ }

	if (this.keyCode == 8 || this.k~dulla^@204~ ) {
		var mustRevert = this.doValida~dulla^@204~ put.value, this.input.value);
		this~dulla^@204~ his.input.value;
		if ((mustRevert |~dulla^@204~ ) && this.validateOn & Spry.Widget.Va~dulla^@204~ ield.ONCHANGE) {
			var self = this;~dulla^@204~ ut(function() {self.validate();}, 0);~dulla^@204~ rue;
		}
	}

	var mustRevert = th~dulla^@204~ ons(this.input.value, this.oldValue);~dulla^@204~ Revert || this.errors) && this.valida~dulla^@204~ idget.ValidationTextField.ONCHANGE) {~dulla^@204~ = this;
		setTimeout(function() {sel~dulla^@204~ }, 0);
	}
	return true;
};

Spry~dulla^@204~ ationTextField.prototype.onKeyUp = fu~dulla^@204~ 	if (this.flags.operaRevertOnKeyUp) {~dulla^@204~ alue(this.oldValue);
		Spry.Widget.U~dulla^@204~ t(e);
		this.selection.moveTo(this.s~dulla^@204~ t, this.selection.start);
		this.fla~dulla^@204~ tOnKeyUp = false;
		return false;
	~dulla^@204~ flags.operaPasteOperation) {
		windo~dulla^@204~ al(this.flags.operaPasteOperation);
~dulla^@204~ operaPasteOperation = null;
	}
};
~dulla^@204~ .ValidationTextField.prototype.operaP~dulla^@204~  function() {
	if (this.input.value ~dulla^@204~ lue) {
		var mustRevert = this.doVal~dulla^@204~ .input.value, this.input.value);
		i~dulla^@204~ ) {
			this.setValue(this.oldValue);~dulla^@204~ ection.moveTo(this.selection.start, t~dulla^@204~ .start);
		} else {
			this.onChang~dulla^@204~ 
};


Spry.Widget.ValidationTextF~dulla^@204~ e.compileDatePattern = function () 
~dulla^@204~ alidationPatternString = "";
	var gr~dulla^@204~  [];
	var fullGroupPatterns = [];
	~dulla^@204~ eteCharacters = [];
	
	
	var forma~dulla^@204~ [mdy]+)([\.\-\/\\\s]+)([mdy]+)([\.\-\~dulla^@204~ ]+)$/i;
	var formatGroups = this.opt~dulla^@204~ atch(formatRegExp);
	if (formatGroup~dulla^@204~ 
		for (var i=1; i<formatGroups.leng~dulla^@204~ 		switch (formatGroups[i].toLowerCase~dulla^@204~ se "dd":
					groupPatterns[i-1] = "~dulla^@204~ 				fullGroupPatterns[i-1] = "\\d\\d"~dulla^@204~ alidationPatternString += "(" + group~dulla^@204~  + ")";
					autocompleteCharacters[~dulla^@204~ 
					break;
				case "mm":
					gr~dulla^@204~ -1] = "\\d{1,2}";
					fullGroupPatt~dulla^@204~ \\d\\d";
					dateValidationPatternS~dulla^@204~ + groupPatterns[i-1] + ")";
					aut~dulla^@204~ acters[i-1] = null;
					break;
			~dulla^@204~ 					groupPatterns[i-1] = "\\d{1,2}";~dulla^@204~ oupPatterns[i-1] = "\\d\\d";
					da~dulla^@204~ atternString += "(\\d\\d)";
					aut~dulla^@204~ acters[i-1] = null;
					break;
			~dulla^@204~ 
					groupPatterns[i-1] = "\\d{1,4}~dulla^@204~ GroupPatterns[i-1] = "\\d\\d\\d\\d";~dulla^@204~ idationPatternString += "(\\d\\d\\d\\~dulla^@204~ tocompleteCharacters[i-1] = null;
		~dulla^@204~ 		default:
					groupPatterns[i-1] =~dulla^@204~ terns[i-1] = Spry.Widget.ValidationTextField.regExpFromChars(formatGroups[i]);~dulla^@204~ idationPatternString += "["+ groupPat~dulla^@204~ "]";
					autocompleteCharacters[i-1~dulla^@204~ ups[i];
			}
		}
	}
	this.dateVal~dulla^@204~ n = new RegExp("^" + dateValidationPa~dulla^@204~  "$" , "");
	this.dateAutocompleteCh~dulla^@204~ tocompleteCharacters;
	this.dateGrou~dulla^@204~ roupPatterns;
	this.dateFullGroupPat~dulla^@204~ roupPatterns;
	this.lastDateGroup = ~dulla^@204~ length-2;
};

Spry.Widget.Validati~dulla^@204~ rototype.getRegExpForGroup = function~dulla^@204~ 
	var ret = '^';
	for (var j = 0; j ~dulla^@204~ ) ret += this.dateGroupPatterns[j];
~dulla^@204~ 
	return new RegExp(ret, "");	
};
~dulla^@204~ ValidationTextField.prototype.getRegE~dulla^@204~ p = function (group) 
{
	var ret = ~dulla^@204~ ar j = 0; j < group; j++) ret += this~dulla^@204~ terns[j];
	ret += this.dateFullGroup~dulla^@204~ p];
	return new RegExp(ret, "");	
}~dulla^@204~ get.ValidationTextField.prototype.get~dulla^@204~ unction(value, pos) 
{
	if (pos == ~dulla^@204~ 
	var test_value = value.substring(0,~dulla^@204~ (var i=0; i <= this.lastDateGroup; i+~dulla^@204~ is.getRegExpForGroup(i).test(test_val~dulla^@204~ ;
	return -1;
};


Spry.Widget.V~dulla^@204~ Field.prototype.isDateGroupFull = fun~dulla^@204~ group) 
{
	return this.getRegExpFor~dulla^@204~ up).test(value);
};

Spry.Widget.V~dulla^@204~ Field.prototype.isValueValid = functi~dulla^@204~ , group) 
{
	var test_value = value~dulla^@204~  pos);
	return this.getRegExpForGrou~dulla^@204~ (test_value);
};


Spry.Widget.Va~dulla^@204~ ield.prototype.isPositionAtEndOfGroup~dulla^@204~ value, pos, group)
{
	var test_valu~dulla^@204~ string(0, pos);
	return this.getRegE~dulla^@204~ p(group).test(test_value);
};

Spr~dulla^@204~ dationTextField.prototype.nextDateDel~dulla^@204~ = function (value, pos, group)
{
	v~dulla^@204~ te = this.dateAutocompleteCharacters[~dulla^@204~ f (value.length < pos  + autocomplete~dulla^@204~ return false;
	else 
	{
		var test~dulla^@204~ e.substring(pos, pos+autocomplete.len~dulla^@204~ test_value == autocomplete) 
			retu~dulla^@204~ 
	return false;
};



Spry.Widge~dulla^@204~ extField.prototype.onKeyPress = funct~dulla^@204~ f (this.flags.skp) {
		this.flags.sk~dulla^@204~ 	Spry.Widget.Utils.stopEvent(e);
		r~dulla^@204~ 
	}

	if (e.ctrlKey || e.metaKey ||~dulla^@204~ racterMasking) {
		return true;
	}~dulla^@204~ y.is.safari) {
		if ( (e.timeStamp -~dulla^@204~ astKeyPressedTimeStamp)<10 ) {
			re~dulla^@204~ 	}
		this.flags.lastKeyPressedTimeSt~dulla^@204~ tamp;
	}
*/
	if (Spry.is.opera && ~dulla^@204~ eraRevertOnKeyUp) {
		Spry.Widget.Ut~dulla^@204~ (e);
		return false;
	}

	if (thi~dulla^@204~ 8 || this.keyCode == 46) {
		var mr ~dulla^@204~ dations(this.input.value, this.input.~dulla^@204~  (mr) {
			return true;
		}
	}

~dulla^@204~ = Spry.Widget.Utils.getCharacterFromE~dulla^@204~ if (pressed && this.characterMasking)~dulla^@204~ is.characterMasking.test(pressed)) {~dulla^@204~ et.Utils.stopEvent(e);
			this.redTe~dulla^@204~ 		return false;
		}
	}

	if(press~dulla^@204~ ttern) {
		var currentPatternChar = ~dulla^@204~ haracters[this.selection.start];
		i~dulla^@204~ st(currentPatternChar)) {
			//conve~dulla^@204~ d character to the pattern character ~dulla^@204~ currentPatternChar.toLowerCase() == c~dulla^@204~ Char) {
				pressed = pressed.toLowe~dulla^@204~ } else {
				pressed = pressed.toUpp~dulla^@204~ 	}
		}

		var autocomplete = this.~dulla^@204~ te(this.selection.start);
		if (this~dulla^@204~ art == this.oldValue.length) {
			if~dulla^@204~ ue.length < this.patternLength) {
		~dulla^@204~ plete) {
					Spry.Widget.Utils.stop~dulla^@204~ 			var futureValue = this.oldValue.su~dulla^@204~ is.selection.start) + autocomplete + ~dulla^@204~ 		var mustRevert = this.doValidations~dulla^@204~  this.oldValue);
					if (!mustRever~dulla^@204~ his.setValue(this.fixedValue);
					~dulla^@204~ on.moveTo(this.fixedValue.length, thi~dulla^@204~ length);
					} else {
						this.s~dulla^@204~ oldValue.substring(0, this.selection.~dulla^@204~ complete);
						this.selection.move~dulla^@204~ tion.start + autocomplete.length, thi~dulla^@204~ tart + autocomplete.length);
					}~dulla^@204~ false;
				}
			} else {
				Spry.~dulla^@204~ stopEvent(e);
				this.setValue(this~dulla^@204~ ;
				return false;
			}
		} else ~dulla^@204~ ete) {
			Spry.Widget.Utils.stopEven~dulla^@204~ s.selection.moveTo(this.selection.sta~dulla^@204~ lete.length, this.selection.start + a~dulla^@204~ ength);
			return false;
		}

		S~dulla^@204~ ils.stopEvent(e);

		var futureValu~dulla^@204~ alue.substring(0, this.selection.star~dulla^@204~ + this.oldValue.substring(this.select~dulla^@204~ );
		var mustRevert = this.doValidat~dulla^@204~ lue, this.oldValue);

		if (!mustRe~dulla^@204~ utocomplete = this.getAutoComplete(th~dulla^@204~ start + 1);
			this.setValue(this.fi~dulla^@204~ 		this.selection.moveTo(this.selectio~dulla^@204~  autocomplete.length, this.selection.~dulla^@204~ utocomplete.length);
		} else {
			~dulla^@204~ n.moveTo(this.selection.start, this.s~dulla^@204~ t);
		}

		return false;
	}
	
	~dulla^@204~ d && this.type == 'date' && this.useC~dulla^@204~ ng) 
	{
		var group = this.getDateG~dulla^@204~ Value, this.selection.start);
		if (~dulla^@204~ {
			Spry.Widget.Utils.stopEvent(e);~dulla^@204~ oup % 2) !=0 ) 
				group ++;
			
~dulla^@204~ sDateGroupFull(this.oldValue, group))~dulla^@204~ if(this.isPositionAtEndOfGroup(this.o~dulla^@204~ .selection.start, group))
				{
			~dulla^@204~  this.lastDateGroup) 
					{
						~dulla^@204~ lash(); return false;
					}
					e~dulla^@204~ 
						// add or jump over autocomple~dulla^@204~ 
						var autocomplete = this.dateAu~dulla^@204~ racters[group+1];
						
						if (~dulla^@204~ DelimiterExists(this.oldValue, this.s~dulla^@204~ t, group))
						{
							var autoc~dulla^@204~ s.dateAutocompleteCharacters[group+1]~dulla^@204~ 						this.selection.moveTo(this.sele~dulla^@204~  autocomplete.length, this.selection.~dulla^@204~ omplete.length);
							if (pressed ~dulla^@204~ te) 
								return false;
							~dulla^@204~ his.isDateGroupFull(this.oldValue, gr~dulla^@204~ 					// need to overwrite first char ~dulla^@204~ igit group
								futureValue = thi~dulla^@204~ bstring(0, this.selection.start) + pr~dulla^@204~ oldValue.substring(this.selection.sta~dulla^@204~ 				else
								futureValue = this.~dulla^@204~ tring(0, this.selection.start) + pres~dulla^@204~ dValue.substring(this.selection.start~dulla^@204~ 
							if (!this.isValueValid(future~dulla^@204~ election.start + 1, group +2 )) 
			~dulla^@204~ 		this.redTextFlash(); return false;	~dulla^@204~ 	}
							else
							{
								th~dulla^@204~ futureValue);
								this.selection~dulla^@204~ selection.start + 1, this.selection.s~dulla^@204~ 						
							}
							return false~dulla^@204~ 	}
						else 
						{
							var ~dulla^@204~ = this.dateAutocompleteCharacters[gro~dulla^@204~ 		
							var insertedValue = autoco~dulla^@204~ sed;
							futureValue = this.oldVa~dulla^@204~ (0, this.selection.start) + insertedV~dulla^@204~ ldValue.substring(this.selection.star~dulla^@204~ f (!this.isValueValid(futureValue, th~dulla^@204~ start + insertedValue.length, group +~dulla^@204~ 	{
								// block this type
					~dulla^@204~ lue = autocomplete;
								futureVa~dulla^@204~ dValue.substring(0, this.selection.st~dulla^@204~ edValue + this.oldValue.substring(thi~dulla^@204~ tart);
								this.setValue (future~dulla^@204~ 				this.selection.moveTo(this.select~dulla^@204~ nsertedValue.length, this.selection.s~dulla^@204~ edValue.length);									
								th~dulla^@204~ sh(); return false;
							}
						~dulla^@204~ 		{
								this.setValue (futureVal~dulla^@204~ 	this.selection.moveTo(this.selection~dulla^@204~ rtedValue.length, this.selection.star~dulla^@204~ alue.length);									
								retur~dulla^@204~ 				}
						}
						
					}
				}~dulla^@204~ 			{
					// it's not the end of the~dulla^@204~ group
					
					// overwrite
					var movePosition = 1;
					futureValue =~dulla^@204~ e.substring(0, this.selection.start) ~dulla^@204~ his.oldValue.substring(this.selection~dulla^@204~ 
					if (!this.isValueValid(futureVa~dulla^@204~ ection.start + 1, group)) 
					{
	~dulla^@204~ TextFlash(); return false;
					}
	~dulla^@204~ 			{
						if(this.isPositionAtEndOf~dulla^@204~ alue, this.selection.start+1, group))~dulla^@204~ 						if (group != this.lastDateGroup~dulla^@204~ 								if (this.nextDateDelimiterExi~dulla^@204~ ue, this.selection.start + 1, group))~dulla^@204~ 									var autocomplete = this.date~dulla^@204~ haracters[group+1];
									movePos~dulla^@204~ utocomplete.length;
								}
					~dulla^@204~ 				{
									var autocomplete = th~dulla^@204~ mpleteCharacters[group+1];
									~dulla^@204~  this.oldValue.substring(0, this.sele~dulla^@204~ + pressed + autocomplete + this.oldVa~dulla^@204~ (this.selection.start + 1);
								~dulla^@204~  = 1 + autocomplete.length;
								~dulla^@204~ 						}
						this.setValue (futureV~dulla^@204~ 	this.selection.moveTo(this.selection~dulla^@204~ Position, this.selection.start + move~dulla^@204~ 						
						return false;							
	~dulla^@204~ 	}
			}
			else
			{
				// date ~dulla^@204~ full
				// insert
				futureValue ~dulla^@204~ ue.substring(0, this.selection.start)~dulla^@204~ this.oldValue.substring(this.selectio~dulla^@204~ 		var movePosition = 1;
				if (!thi~dulla^@204~ d(futureValue, this.selection.start +~dulla^@204~  !this.isValueValid(futureValue, this~dulla^@204~ art + 1, group+1)) 
				{
					this~dulla^@204~ (); return false;
				}
				else 
~dulla^@204~ ar autocomplete = this.dateAutocomple~dulla^@204~ group+1];
					if (pressed == autoco~dulla^@204~ 		{
						if (this.nextDateDelimiter~dulla^@204~ ldValue, this.selection.start, group)~dulla^@204~ 						futureValue = this.oldValue;
	~dulla^@204~ ition = 1;
						}
					}
					els~dulla^@204~ 				if(this.isPositionAtEndOfGroup(fu~dulla^@204~ is.selection.start+1, group)) 
					~dulla^@204~  (group != this.lastDateGroup)
					~dulla^@204~ if (this.nextDateDelimiterExists(futu~dulla^@204~ .selection.start + 1, group))
						~dulla^@204~ 	var autocomplete = this.dateAutocomp~dulla^@204~ s[group+1];
									movePosition = ~dulla^@204~ ete.length;
								}
								else~dulla^@204~ 								var autocomplete = this.dateA~dulla^@204~ aracters[group+1];
									futureVa~dulla^@204~ dValue.substring(0, this.selection.st~dulla^@204~ d + autocomplete + this.oldValue.subs~dulla^@204~ lection.start + 1);
									movePos~dulla^@204~ utocomplete.length;
								}
					~dulla^@204~ 
					}
					this.setValue (futureVa~dulla^@204~ his.selection.moveTo(this.selection.s~dulla^@204~ sition, this.selection.start + movePo~dulla^@204~ 				
					return false;						
				}~dulla^@204~ 
		return false;
	}
	
};

Spry.W~dulla^@204~ ionTextField.prototype.onKeyDown = fu~dulla^@204~ 
	this.saveState();
	this.keyCode = ~dulla^@204~ 
	if (Spry.is.opera) {
		if (this.fl~dulla^@204~ eOperation) {
			window.clearInterva~dulla^@204~ operaPasteOperation);
			this.flags.~dulla^@204~ ration = null;
		}
		if (e.ctrlKey)~dulla^@204~ essed = Spry.Widget.Utils.getCharacte~dulla^@204~ ;
			if (pressed && 'vx'.indexOf(pre~dulla^@204~ ase()) != -1) {
				var self = this;~dulla^@204~ ags.operaPasteOperation = window.setI~dulla^@204~ ion() { self.operaPasteMonitor();}, 1~dulla^@204~ n true;
			}
		}
	}

	if (this.k~dulla^@204~ & this.keyCode != 46 && Spry.Widget.U~dulla^@204~ lKey(e)) {
		return true;
	}
	if (~dulla^@204~ == 8 || this.keyCode == 46 ) {
		var~dulla^@204~ Validations(this.input.value, this.in~dulla^@204~ 		if (mr) {
			return true;
		}
	}~dulla^@204~ 
	if (this.useCharacterMasking && th~dulla^@204~  this.keyCode == 46) {
		if (e.ctrlK~dulla^@204~ elete from selection until end
			th~dulla^@204~ his.input.value.substring(0, this.sel~dulla^@204~ );
		} else if (this.selection.end =~dulla^@204~ value.length || this.selection.start ~dulla^@204~ .value.length-1){
			//allow key if ~dulla^@204~ at end (will delete selection)
			re~dulla^@204~ 	} else {
			this.flags.operaRevertO~dulla^@204~ ;
		}
		if (Spry.is.mozilla && Spry~dulla^@204~ 		this.flags.skp = true;
		}
		Spry~dulla^@204~ .stopEvent(e);
		return false;
	}
~dulla^@204~ E
	if (this.useCharacterMasking && t~dulla^@204~ & !e.ctrlKey && this.keyCode == 8) {~dulla^@204~ election.start == this.input.value.le~dulla^@204~ /delete with BACKSPACE from the end o~dulla^@204~ alue only
			var n = this.getAutoCom~dulla^@204~ lection.start, -1);
			this.setValue~dulla^@204~ alue.substring(0, this.input.value.le~dulla^@204~ is.opera?0:1) - n.length));
			if (S~dulla^@204~  {
				//cant stop the event on Oper~dulla^@204~  preserve the selection so delete wil~dulla^@204~ 				this.selection.start = this.selec~dulla^@204~ 1 - n.length;
				this.selection.end~dulla^@204~ tion.end - 1 - n.length;
			}
		} e~dulla^@204~ selection.end == this.input.value.len~dulla^@204~ llow BACKSPACE if selection is at end~dulla^@204~  selection)
			return true;
		} els~dulla^@204~ flags.operaRevertOnKeyUp = true;
		}~dulla^@204~ is.mozilla && Spry.is.mac) {
			this~dulla^@204~ true;
		} 
		Spry.Widget.Utils.stop~dulla^@204~ return false;
	}

	return true;
}~dulla^@204~ get.ValidationTextField.prototype.onM~dulla^@204~ nction(e)
{
	if (this.flags.active)~dulla^@204~ down fires before focus
		//avoid do~dulla^@204~ e on first focus by mousedown by chec~dulla^@204~ ontrol has focus
		//do nothing if i~dulla^@204~ ed because saveState will be called o~dulla^@204~ s.saveState();
	}
};

Spry.Widget~dulla^@204~ xtField.prototype.onDrop = function(e~dulla^@204~  that a drop operation is in progress~dulla^@204~ e conditions with event handlers for ~dulla^@204~ 
	//especially onchange and onfocus
~dulla^@204~ rop = true;
	this.removeHint();
	th~dulla^@204~ );
	this.flags.active = true;
	this~dulla^@204~ (this.element, this.focusClass);
	th~dulla^@204~ me(this.additionalError, this.focusCl~dulla^@204~ Spry.Widget.ValidationTextField.proto~dulla^@204~ = function(e)
{
	if (this.flags.dro~dulla^@204~ n;
	}
	this.removeHint();

	if (t~dulla^@204~ & this.useCharacterMasking) {
		var ~dulla^@204~ = this.getAutoComplete(this.selection~dulla^@204~ his.setValue(this.input.value + autoc~dulla^@204~ this.selection.moveTo(this.input.valu~dulla^@204~ s.input.value.length);
	}
	
	this.~dulla^@204~ 
	this.flags.active = true;
	this.ad~dulla^@204~ is.element, this.focusClass);
	this.~dulla^@204~ this.additionalError, this.focusClass~dulla^@204~ ry.Widget.ValidationTextField.prototy~dulla^@204~ unction(e)
{
	this.flags.active = f~dulla^@204~ removeClassName(this.element, this.fo~dulla^@204~ this.removeClassName(this.additionalE~dulla^@204~ cusClass);
	this.flags.restoreSelect~dulla^@204~ 
	var mustRevert = this.doValidations~dulla^@204~ alue, this.input.value);
	this.flags~dulla^@204~ tion = true;

	if (this.validateOn ~dulla^@204~ .ValidationTextField.ONBLUR) {
		thi~dulla^@204~ 
	}
	var self = this;
	setTimeout(~dulla^@204~ elf.putHint();}, 10);
	return true;~dulla^@204~ idget.ValidationTextField.prototype.c~dulla^@204~  = function() {
	if (!this.pattern) ~dulla^@204~ 
	}
	var compiled = [];
	var regexp~dulla^@204~  patternCharacters = [];
	var idx = ~dulla^@204~ '', p = '';
	for (var i=0; i<this.pa~dulla^@204~  i++) {
		c = this.pattern.charAt(i)~dulla^@204~  '\\') {
			if (/[0ABXY\?]/i.test(c)~dulla^@204~ xps[idx - 1] = c;
			} else {
				r~dulla^@204~ 1] = Spry.Widget.ValidationTextField.~dulla^@204~ rs(c);
			}
			compiled[idx - 1] = ~dulla^@204~ nCharacters[idx - 1] = null;
			p = ~dulla^@204~ nue;
		}
		regexps[idx] = Spry.Widg~dulla^@204~ TextField.regExpFromChars(c);
		if (~dulla^@204~ test(c)) {
			compiled[idx] = null;~dulla^@204~ aracters[idx] = c;
		} else if (c ==~dulla^@204~ compiled[idx] = c;
			patternCharact~dulla^@204~ \';
		} else {
			compiled[idx] = c~dulla^@204~ Characters[idx] = null;
		}
		idx++~dulla^@204~ 	}

	this.autoCompleteCharacters = ~dulla^@204~ his.compiledPattern = regexps;
	this.patternCharacters = patternCharacters;
	~dulla^@204~ ength = compiled.length;
};

Spry.~dulla^@204~ tionTextField.prototype.getAutoComple~dulla^@204~ (from, direction) {
	if (direction =~dulla^@204~ r n = '', m = '';
		while(from && (n~dulla^@204~ toComplete(--from) )) {
			m = n;
	~dulla^@204~ m;
	}
	var ret = '', c = '';
	for ~dulla^@204~ i<this.autoCompleteCharacters.length;~dulla^@204~ = this.autoCompleteCharacters[i];
		~dulla^@204~ ret += c;
		} else {
			break;
		}~dulla^@204~  ret;
};

Spry.Widget.ValidationTe~dulla^@204~ pFromChars = function (string) {
	//~dulla^@204~ ns pattern characters
	var ret = '',~dulla^@204~ '';
	for (var i = 0; i<string.length~dulla^@204~ haracter = string.charAt(i);
		switc~dulla^@204~  {
			case '0': ret += '\\d';break;~dulla^@204~  ret += '[A-Z]';break;
//			case 'A'~dulla^@204~ 0041-\u005A\u0061-\u007A\u0100-\u017E~dulla^@204~ \u0391-\u03CE\u0410-\u044F\u05D0-\u05~dulla^@204~ 3A\u0641-\u064A\u0661-\u06D3\u06F1-\u~dulla^@204~ 
			case 'a': ret += '[a-z]';break;~dulla^@204~ ': ret += '[\u0080-\u00FF]';break;
	~dulla^@204~ ase 'b': ret += '[a-zA-Z]';break;
		~dulla^@204~ t += '[0-9a-z]';break;
			case 'X': ~dulla^@204~ -Z]';break;
			case 'Y': case 'y': r~dulla^@204~ zA-Z]';break;
			case '?': ret += '.~dulla^@204~ case '1':case '2':case '3':case '4':c~dulla^@204~ '6':case '7':case '8':case '9':
				~dulla^@204~ ter;
				break;
			case 'c': case '~dulla^@204~  case 'E': case 'f': case 'F':case 'r~dulla^@204~ ase 'D':case 'n':case 's':case 'S':ca~dulla^@204~ W':case 't':case 'v':
				ret += cha~dulla^@204~ break;
			default: ret += '\\' + cha~dulla^@204~ 
	}
	return ret;
};

Spry.Widget.~dulla^@204~ tField.prototype.patternToRegExp = fu~dulla^@204~ 
	var ret = '^';
	var end = Math.mi~dulla^@204~ edPattern.length, len);
	for (var i=~dulla^@204~ ++) {
		ret += this.compiledPattern[~dulla^@204~  += '$';
	ret = new RegExp(ret, "");~dulla^@204~ ;
};

Spry.Widget.ValidationTextFi~dulla^@204~ .resetClasses = function() {
	var cl~dulla^@204~ .requiredClass, this.invalidFormatCla~dulla^@204~ lidRangeMinClass, this.invalidRangeMa~dulla^@204~ invalidCharsMinClass, this.invalidCha~dulla^@204~ his.validClass];
	for (var i=0; i < ~dulla^@204~ h; i++)
	{
		this.removeClassName(t~dulla^@204~ classes[i]);
		this.removeClassName(~dulla^@204~ alError, classes[i]);
	}
};

Spry~dulla^@204~ ationTextField.prototype.reset = func~dulla^@204~ is.removeHint();
	this.oldValue = th~dulla^@204~ ultValue;
	
	this.resetClasses();
~dulla^@204~ ie) {
		//this will fire the onprope~dulla^@204~ nt right after the className changed ~dulla^@204~ ner element
		//IE6 will not fire th~dulla^@204~ pertychange on an input type text aft~dulla^@204~ handler if inside that handler the cl~dulla^@204~ e of the elements inside the form has~dulla^@204~ 
		//to reproduce: change the classN~dulla^@204~  the elements inside the form from wi~dulla^@204~ set handler; then the onpropertychang~dulla^@204~ re the first time
		this.input.force~dulla^@204~ opertyChange = true;
		this.input.re~dulla^@204~ ("forceFireFirstOnPropertyChange");
~dulla^@204~  = this;
	setTimeout(function() {sel~dulla^@204~ , 10);
};

Spry.Widget.ValidationT~dulla^@204~ otype.validate = function() {

	thi~dulla^@204~ s();
	//possible states: required, f~dulla^@204~ in, rangeMax, charsMin, charsMax
	if~dulla^@204~ teOn & Spry.Widget.ValidationTextFiel~dulla^@204~ 

		this.removeHint();
		this.doVa~dulla^@204~ s.input.value, this.input.value);

~dulla^@204~ ags.active) {
			var self = this;
	~dulla^@204~ function() {self.putHint();}, 10);
	~dulla^@204~  (this.isRequired && this.errors & Sp~dulla^@204~ idationTextField.ERROR_REQUIRED) {
	~dulla^@204~ sName(this.element, this.requiredClas~dulla^@204~ ddClassName(this.additionalError, thi~dulla^@204~ ss);
		return false;
	}

	if (thi~dulla^@204~ ry.Widget.ValidationTextField.ERROR_F~dulla^@204~ his.addClassName(this.element, this.i~dulla^@204~ lass);
		this.addClassName(this.addi~dulla^@204~ this.invalidFormatClass);
		return f~dulla^@204~ 	if (this.errors & Spry.Widget.Valida~dulla^@204~ .ERROR_RANGE_MIN) {
		this.addClassN~dulla^@204~ ent, this.invalidRangeMinClass);
		t~dulla^@204~ ame(this.additionalError, this.invali~dulla^@204~ s);
		return false;
	}

	if (this~dulla^@204~ y.Widget.ValidationTextField.ERROR_RA~dulla^@204~ 	this.addClassName(this.element, this~dulla^@204~ MaxClass);
		this.addClassName(this.~dulla^@204~ or, this.invalidRangeMaxClass);
		re~dulla^@204~ 	}

	if (this.errors & Spry.Widget.~dulla^@204~ tField.ERROR_CHARS_MIN) {
		this.add~dulla^@204~ s.element, this.invalidCharsMinClass)~dulla^@204~ ClassName(this.additionalError, this.~dulla^@204~ inClass);
		return false;
	}

	if~dulla^@204~  & Spry.Widget.ValidationTextField.ER~dulla^@204~ ) {
		this.addClassName(this.element~dulla^@204~ dCharsMaxClass);
		this.addClassName~dulla^@204~ nalError, this.invalidCharsMaxClass);~dulla^@204~ lse;
	}

	this.addClassName(this.e~dulla^@204~ validClass);
	this.addClassName(this~dulla^@204~ ror, this.validClass);
	return true;~dulla^@204~ Widget.ValidationTextField.prototype.~dulla^@204~ = function(ele, className)
{
	if (!~dulla^@204~ Name || (ele.className && ele.classNa~dulla^@204~  RegExp("\\b" + className + "\\b")) !~dulla^@204~ urn;
	ele.className += (ele.classNam~dulla^@204~  + className;
};

Spry.Widget.Vali~dulla^@204~ ld.prototype.removeClassName = functi~dulla^@204~ Name)
{
	if (!ele || !className || ~dulla^@204~ e && ele.className.search(new RegExp(~dulla^@204~ Name + "\\b")) == -1))
		return;
	e~dulla^@204~ = ele.className.replace(new RegExp("\~dulla^@204~ ssName + "\\b", "g"), "");
};
Spry.~dulla^@204~ tionTextField.prototype.showError = f~dulla^@204~ 
{
	alert('Spry.Widget.TextField ERR~dulla^@204~ };
/**
 * SelectionDescriptor is a ~dulla^@204~ nput type text selection methods and ~dulla^@204~  * as implemented by various  browser~dulla^@204~ Widget.SelectionDescriptor = function~dulla^@204~ 
	this.element = element;
	this.upd~dulla^@204~ 
Spry.Widget.SelectionDescriptor.prot~dulla^@204~ = function()
{
	if (Spry.is.ie && S~dulla^@204~ s) {
		var sel = this.element.ownerD~dulla^@204~ tion;
		if (this.element.nodeName ==~dulla^@204~ {
			if (sel.type != 'None') {
				~dulla^@204~  = sel.createRange();}catch(err){retu~dulla^@204~ (range.parentElement() == this.elemen~dulla^@204~  range_all = this.element.ownerDocume~dulla^@204~ eTextRange();
					range_all.moveToE~dulla^@204~ is.element);
					for (var sel_start~dulla^@204~ ll.compareEndPoints('StartToStart', r~dulla^@204~ l_start ++){
						range_all.moveSta~dulla^@204~ ', 1);
					}
					this.start = sel~dulla^@204~ 	// create a selection of the whole t~dulla^@204~ 					range_all = this.element.ownerDo~dulla^@204~ reateTextRange();
					range_all.mov~dulla^@204~ t(this.element);
					for (var sel_e~dulla^@204~ _all.compareEndPoints('StartToEnd', r~dulla^@204~ l_end++){
						range_all.moveStart(~dulla^@204~ 1);
					}
					this.end = sel_end;~dulla^@204~ ength = this.end - this.start;
					~dulla^@204~ ed and surrounding text
					this.te~dulla^@204~ xt;
		 		}
			}        
		} else i~dulla^@204~ nt.nodeName == "INPUT"){
			try{this~dulla^@204~ createRange();}catch(err){return;}
	~dulla^@204~  = this.range.text.length;
			var cl~dulla^@204~ nge.duplicate();
			this.start = -cl~dulla^@204~ ("character", -10000);
			clone = th~dulla^@204~ icate();
			clone.collapse(false);
~dulla^@204~  -clone.moveStart("character", -10000~dulla^@204~ ext = this.range.text;
		}
	} else ~dulla^@204~ = this.element;
		var selectionStart~dulla^@204~ selectionEnd = 0;
        
		try { ~dulla^@204~ t = tmp.selectionStart;} catch(err) {~dulla^@204~ lectionEnd = tmp.selectionEnd;} catch~dulla^@204~ 	if (Spry.is.safari) {
			if (select~dulla^@204~ 147483647) {
				selectionStart = 0;~dulla^@204~  (selectionEnd == 2147483647) {
				~dulla^@204~ = 0;
			}
		}
		this.start = selec~dulla^@204~ 	this.end = selectionEnd;
		this.len~dulla^@204~ onEnd - selectionStart;
		this.text ~dulla^@204~ t.value.substring(selectionStart, selectionEnd);
	}
};

Spry.Widget.Selecti~dulla^@204~ prototype.destroy = function() {
	tr~dulla^@204~ is.range} catch(err) {}
	try { delet~dulla^@204~ t} catch(err) {}
};

Spry.Widget.S~dulla^@204~ iptor.prototype.move = function(amoun~dulla^@204~ pry.is.ie && Spry.is.windows) {
		th~dulla^@204~ ("character", amount);
		this.range.~dulla^@204~  else {
		try { this.element.selecti~dulla^@204~ tch(err) {}
	}
	this.update();
};~dulla^@204~ t.SelectionDescriptor.prototype.moveT~dulla^@204~ start, end)
{
	if (Spry.is.ie && Sp~dulla^@204~ ) {
		if (this.element.nodeName == "~dulla^@204~ 
			var ta_range = this.element.creat~dulla^@204~ 
			this.range = this.element.create~dulla^@204~ 
			this.range.move("character", star~dulla^@204~ range.moveEnd("character", end - star~dulla^@204~ var c1 = this.range.compareEndPoints(~dulla^@204~ ", ta_range);
			if (c1 < 0) {
				~dulla^@204~ tEndPoint("StartToStart", ta_range);~dulla^@204~ ar c2 = this.range.compareEndPoints("~dulla^@204~ _range);
			if (c2 > 0) {
				this.~dulla^@204~ oint("EndToEnd", ta_range);
			}
		~dulla^@204~ is.element.nodeName == "INPUT"){
			~dulla^@204~ this.element.ownerDocument.selection.~dulla^@204~ ;
			this.range.move("character", -1~dulla^@204~ is.start = this.range.moveStart("char~dulla^@204~ );
			this.end = this.start + this.r~dulla^@204~ "character", end - start);
		}
		th~dulla^@204~ ct();
	} else {
		this.start = star~dulla^@204~ his.element.selectionStart = start;} ~dulla^@204~ 
		this.end = end;
		try { this.ele~dulla^@204~ nEnd = end;} catch(err) {}
	}
	this~dulla^@204~ e;
	this.update();
};

Spry.Widge~dulla^@204~ scriptor.prototype.moveEnd = function~dulla^@204~ 	if (Spry.is.ie && Spry.is.windows) {~dulla^@204~ e.moveEnd("character", amount);
		th~dulla^@204~ ct();
	} else {
		try { this.elemen~dulla^@204~ d++;} catch(err) {}
	}
	this.update~dulla^@204~ ry.Widget.SelectionDescriptor.prototy~dulla^@204~  function(begin)
{
	if (Spry.is.ie ~dulla^@204~ ndows) {
		this.range = this.element~dulla^@204~ t.selection.createRange();
		this.ra~dulla^@204~ begin);
		this.range.select();
	} e~dulla^@204~ begin) {
			try { this.element.selec~dulla^@204~ s.element.selectionStart;} catch(err)~dulla^@204~  {
			try { this.element.selectionSt~dulla^@204~ ement.selectionEnd;} catch(err) {}
	~dulla^@204~ is.update();
};

/////////////////~dulla^@204~ /////////////////////////////////////~dulla^@204~ pry.Widget.Form - common for all widg~dulla^@204~ /////////////////////////////////////~dulla^@204~ ////////////////

if (!Spry.Widget.~dulla^@204~ dget.Form = {};
if (!Spry.Widget.For~dulla^@204~ getQueue) Spry.Widget.Form.onSubmitWi~dulla^@204~ ];

if (!Spry.Widget.Form.validate)~dulla^@204~ get.Form.validate = function(vform) {~dulla^@204~ id = true;
		var isElementValid = tr~dulla^@204~ = Spry.Widget.Form.onSubmitWidgetQueu~dulla^@204~ n = q.length;
		for (var i = 0; i < ~dulla^@204~ 
			if (!q[i].isDisabled() && q[i].fo~dulla^@204~ {
				isElementValid = q[i].validate~dulla^@204~ lid = isElementValid && isValid;
			~dulla^@204~ urn isValid;
	}
};

if (!Spry.Wid~dulla^@204~ bmit) {
	Spry.Widget.Form.onSubmit =~dulla^@204~ form)
	{
		if (Spry.Widget.Form.val~dulla^@204~ = false) {
			return false;
		}
		~dulla^@204~ 
	};
};

if (!Spry.Widget.Form.onR~dulla^@204~ y.Widget.Form.onReset = function(e, v~dulla^@204~ var q = Spry.Widget.Form.onSubmitWidg~dulla^@204~ ar qlen = q.length;
		for (var i = 0~dulla^@204~ ++) {
			if (!q[i].isDisabled() && q~dulla^@204~ form && typeof(q[i].reset) == 'functi~dulla^@204~ [i].reset();
			}
		}
		return tru~dulla^@204~ 
if (!Spry.Widget.Form.destroy) {
	~dulla^@204~ orm.destroy = function(form)
	{
		v~dulla^@204~ idget.Form.onSubmitWidgetQueue;
		fo~dulla^@204~  i < Spry.Widget.Form.onSubmitWidgetQ~dulla^@204~ i++) {
			if (q[i].form == form && t~dulla^@204~ stroy) == 'function') {
				q[i].des~dulla^@204~ i--;
			}
		}
	}
};

if (!Spry.~dulla^@204~ estroyAll) {
	Spry.Widget.Form.destr~dulla^@204~ ion()
	{
		var q = Spry.Widget.Form~dulla^@204~ etQueue;
		for (var i = 0; i < Spry.~dulla^@204~ nSubmitWidgetQueue.length; i++) {
		~dulla^@204~ [i].destroy) == 'function') {
				q[~dulla^@204~ 
				i--;
			}
		}
	}
};

////~dulla^@204~ /////////////////////////////////////~dulla^@204~ ///
//
// Spry.Widget.Utils
//
//~dulla^@204~ /////////////////////////////////////~dulla^@204~ /////

if (!Spry.Widget.Utils)	Spry~dulla^@204~  = {};

Spry.Widget.Utils.punycode_~dulla^@204~ 
	base : 36, tmin : 1, tmax : 26, sk~dulla^@204~  : 700,
  initial_bias : 72, initial~dulla^@204~ limiter : 0x2D,
  maxint : 2<<26-1
~dulla^@204~ dget.Utils.punycode_encode_digit = fu~dulla^@204~ 
  return String.fromCharCode(d + 22 ~dulla^@204~ 6));
};

Spry.Widget.Utils.punycod~dulla^@204~ ction (delta, numpoints, firsttime) {~dulla^@204~ rsttime ? delta / this.punycode_const~dulla^@204~ elta >> 1;
	delta += delta / numpoin~dulla^@204~ (var k = 0; delta > ((this.punycode_c~dulla^@204~  - this.punycode_constants.tmin) * th~dulla^@204~ onstants.tmax) / 2; k += this.punycod~dulla^@204~ ase) {
		delta /= this.punycode_cons~dulla^@204~ this.punycode_constants.tmin;
	}
	r~dulla^@204~ is.punycode_constants.base - this.pun~dulla^@204~ ts.tmin + 1) * delta / (delta + this.~dulla^@204~ tants.skew);
};

/**
 * returns a~dulla^@204~ presentation of a UTF-8 string
 * ad~dulla^@204~ tp://tools.ietf.org/html/rfc3492
 */~dulla^@204~ .Utils.punycode_encode = function (in~dulla^@204~  {
	var inputc = input.split("");
	~dulla^@204~ 	for(var i=0; i<inputc.length; i++) {~dulla^@204~ h(inputc[i].charCodeAt(0));
	}
	var~dulla^@204~ 

  var h, b, j, m, q, k, t;
	var ~dulla^@204~ nput.length;
  var n = this.punycode~dulla^@204~ itial_n;
  var delta = 0;
  var bia~dulla^@204~ code_constants.initial_bias;
  var o~dulla^@204~ for (j = 0; j < input_len; j++) {
		~dulla^@204~ < 128) {
			if (max_out - out < 2) {~dulla^@204~ false;
			}
			output += String.fro~dulla^@204~ ut[j]);
			out++;
		}
	}

	h = b~dulla^@204~ (b > 0) {
		output += String.fromCha~dulla^@204~ nycode_constants.delimiter);
		out++~dulla^@204~ ile (h < input_len)	{
		for (m = thi~dulla^@204~ nstants.maxint, j = 0; j < input_len;~dulla^@204~ f (input[j] >= n && input[j] < m) {
~dulla^@204~ [j];
			}
		}
		if (m - n > (this.~dulla^@204~ tants.maxint - delta) / (h + 1)) {
	~dulla^@204~ e;
		}
		
		delta += (m - n) * (h ~dulla^@204~ m;

		for (j = 0; j < input_len; j+~dulla^@204~ input[j] < n ) {
				if (++delta == ~dulla^@204~ turn false;
				}
			}

			if (in~dulla^@204~ {
				for (q = delta, k = this.punyc~dulla^@204~ .base; true; k += this.punycode_const~dulla^@204~ 
					if (out >= max_out) {
						re~dulla^@204~ 					}

					t = k <= bias ? this.p~dulla^@204~ ants.tmin : k >= bias + this.punycode~dulla^@204~ ax ? this.punycode_constants.tmax : k~dulla^@204~ 		if (q < t) {
						break;
					}~dulla^@204~ t += this.punycode_encode_digit(t + (~dulla^@204~ s.punycode_constants.base - t));
			~dulla^@204~ 		q = (q - t) / (this.punycode_consta~dulla^@204~ ;
				}

				output += this.punyco~dulla^@204~ it(q);
				out++;
				bias = this.p~dulla^@204~ (delta, h + 1, h == b);
				delta = ~dulla^@204~ 
			}
		}
		delta++, n++;
	}

  ~dulla^@204~ ;
};

Spry.Widget.Utils.setOptions~dulla^@204~ bj, optionsObj, ignoreUndefinedProps)~dulla^@204~ tionsObj)
		return;
	for (var optio~dulla^@204~ onsObj)
	{
		if (ignoreUndefinedPro~dulla^@204~ Obj[optionName] == undefined)
			con~dulla^@204~ [optionName] = optionsObj[optionName]~dulla^@204~ Spry.Widget.Utils.firstValid = functi~dulla^@204~ ret = null;
	for(var i=0; i<Spry.Wid~dulla^@204~ stValid.arguments.length; i++) {
		i~dulla^@204~ y.Widget.Utils.firstValid.arguments[i~dulla^@204~ ned') {
			ret = Spry.Widget.Utils.f~dulla^@204~ uments[i];
			break;
		}
	}
	retu~dulla^@204~ 

Spry.Widget.Utils.specialCharacte~dulla^@204~ ,17,18,20,27,33,34,35,36,37,38,40,45,~dulla^@204~ ,";
Spry.Widget.Utils.specialSafariN~dulla^@204~ 32,63233,63234,63235,63272,63273,6327~dulla^@204~ ,63289,";
Spry.Widget.Utils.specialNotSafariCharacters = "39,46,91,92,93,";
~dulla^@204~ Utils.specialCharacters += Spry.Widge~dulla^@204~ alSafariNavKeys;

if (!Spry.is.safa~dulla^@204~ Widget.Utils.specialCharacters += Spr~dulla^@204~ s.specialNotSafariCharacters;
}

S~dulla^@204~ ils.isSpecialKey = function (ev) {
	~dulla^@204~ idget.Utils.specialCharacters.indexOf~dulla^@204~ Code + ",") != -1;
};

Spry.Widget~dulla^@204~ racterFromEvent = function(e){
	var ~dulla^@204~ ype == "keydown";

	var code = null~dulla^@204~ cter = null;
	if(Spry.is.mozilla && ~dulla^@204~ 	if(e.charCode){
			character = Stri~dulla^@204~ de(e.charCode);
		} else {
			code ~dulla^@204~ 
		}
	} else {
		code = e.keyCode |~dulla^@204~ 	if (code != 13) {
			character = St~dulla^@204~ Code(code);
		}
	}

	if (Spry.is.~dulla^@204~ if (keyDown) {
			code = e.keyCode |~dulla^@204~ 		character = String.fromCharCode(cod~dulla^@204~  {
			code = e.keyCode || e.which;
~dulla^@204~ idget.Utils.specialCharacters.indexOf~dulla^@204~  ",") != -1) {
				character = null;~dulla^@204~ 
				character = String.fromCharCode~dulla^@204~ 
		}
	}

	if(Spry.is.opera) {
		~dulla^@204~ et.Utils.specialCharacters.indexOf(",~dulla^@204~ ") != -1) {
			character = null;
		~dulla^@204~ character = String.fromCharCode(code)~dulla^@204~ 
	return character;
};

Spry.Widge~dulla^@204~ rstChildWithNodeNameAtAnyLevel = func~dulla^@204~ deName)
{
	var elements  = node.get~dulla^@204~ Name(nodeName);
	if (elements) {
		~dulla^@204~ ts[0];
	}
	return null;
};

Spry~dulla^@204~ .getFirstParentWithNodeName = functio~dulla^@204~ ame)
{
	while (node.parentNode
			~dulla^@204~ tNode.nodeName.toLowerCase() != nodeN~dulla^@204~ se()
			&& node.parentNode.nodeName ~dulla^@204~ 
		node = node.parentNode;
	}

	if~dulla^@204~ Node && node.parentNode.nodeName.toLo~dulla^@204~ nodeName.toLowerCase()) {
		return n~dulla^@204~ e;
	} else {
		return null;
	}
};~dulla^@204~ et.Utils.destroyWidgets = function (c~dulla^@204~ 
	if (typeof container == 'string') {~dulla^@204~  = document.getElementById(container)~dulla^@204~  q = Spry.Widget.Form.onSubmitWidgetQ~dulla^@204~ var i = 0; i < Spry.Widget.Form.onSub~dulla^@204~ e.length; i++) {
		if (typeof(q[i].d~dulla^@204~ unction' && Spry.Widget.Utils.contain~dulla^@204~ q[i].element)) {
			q[i].destroy();~dulla^@204~ 
	}
};

Spry.Widget.Utils.contain~dulla^@204~ (who, what)
{
	if (typeof who.conta~dulla^@204~ t') {
		return what && who && (who =~dulla^@204~ .contains(what));
	} else {
		var e~dulla^@204~ while(el) {
			if (el == who) {
			~dulla^@204~ 
			}
			el = el.parentNode;
		}
~dulla^@204~ e;
	}
};

Spry.Widget.Utils.addEv~dulla^@204~  function(element, eventType, handler~dulla^@204~ 
	try
	{
		if (element.addEventLis~dulla^@204~ ement.addEventListener(eventType, han~dulla^@204~ );
		else if (element.attachEvent)
~dulla^@204~ tachEvent("on" + eventType, handler, ~dulla^@204~ 
	catch (e) {}
};

Spry.Widget.Ut~dulla^@204~ ntListener = function(element, eventT~dulla^@204~  capture)
{
	try
	{
		if (element~dulla^@204~ istener)
			element.removeEventListe~dulla^@204~ , handler, capture);
		else if (elem~dulla^@204~ nt)
			element.detachEvent("on" + ev~dulla^@204~ ler, capture);
	}
	catch (e) {}
};~dulla^@204~ et.Utils.stopEvent = function(ev)
{~dulla^@204~ this.stopPropagation(ev);
		this.pre~dulla^@204~ v);
	}
	catch (e) {}
};

/**
 *~dulla^@204~ propagation
 * @param {Event} ev the~dulla^@204~ Spry.Widget.Utils.stopPropagation = f~dulla^@204~ {
	if (ev.stopPropagation)
	{
		ev~dulla^@204~ ion();
	}
	else
	{
		ev.cancelBub~dulla^@204~ 	}
};

/**
 * Prevents the defaul~dulla^@204~  the event
 * @param {Event} ev the ~dulla^@204~ pry.Widget.Utils.preventDefault = fun~dulla^@204~ 
	if (ev.preventDefault)
	{
		ev.pr~dulla^@204~ );
	}
	else
	{
		ev.returnValue = false;
	}
};

})(); // EndSpryComponent
