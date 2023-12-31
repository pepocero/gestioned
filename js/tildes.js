function htmlEntities(str) {
    return String(str).replace(/&ntilde;/g, 'ñ')
                      .replace(/&Ntilde;/g, 'Ñ')
                      .replace(/&amp;/g, '&')
                      .replace(/&Agrave;/g, 'À')
                      .replace(/&Aacute;/g, 'Á')
                      .replace(/&Acirc;/g, 'Â')
                      .replace(/&Atilde;/g, 'Ã')
                      .replace(/&Auml;/g, 'Ä')
                      .replace(/&Aring;/g, 'Å')
                      .replace(/&AElig;/g, 'Æ')
                      .replace(/&Ccedil;/g, 'Ç')
                      .replace(/&Egrave;/g, 'È')
                      .replace(/&Eacute;/g, 'É')
                      .replace(/&Ecirc;/g, 'Ê')
                      .replace(/&Euml;/g, 'Ë')
                      .replace(/&Igrave;/g, 'Ì')
                      .replace(/&Iacute;/g, 'Í')
                      .replace(/&Icirc;/g, 'Î')
                      .replace(/&Iuml;/g, 'Ï')
                      .replace(/&ETH;/g, 'Ð')
                      .replace(/&Ntilde;/g, 'Ñ')
                      .replace(/&Ograve;/g, 'Ò')
                      .replace(/&Oacute;/g, 'Ó')
                      .replace(/&Ocirc;/g, 'Ô')
                      .replace(/&Otilde;/g, 'Õ')
                      .replace(/&Ouml;/g, 'Ö')
                      .replace(/&Oslash;/g, 'Ø')
                      .replace(/&Ugrave;/g, 'Ù')
                      .replace(/&Uacute;/g, 'Ú')
                      .replace(/&Ucirc;/g, 'Û')
                      .replace(/&Uuml;/g, 'Ü')
                      .replace(/&Yacute;/g, 'Ý')
                      .replace(/&THORN;/g, 'Þ')
                      .replace(/&szlig;/g, 'ß')
                      .replace(/&agrave;/g, 'à')
                      .replace(/&aacute;/g, 'á')
                      .replace(/&acirc;/g, 'â')
                      .replace(/&atilde;/g, 'ã')
                      .replace(/&auml;/g, 'ä')
                      .replace(/&aring;/g, 'å')
                      .replace(/&aelig;/g, 'æ')
                      .replace(/&ccedil;/g, 'ç')
                      .replace(/&egrave;/g, 'è')
                      .replace(/&eacute;/g, 'é')
                      .replace(/&ecirc;/g, 'ê')
                      .replace(/&euml;/g, 'ë')
                      .replace(/&igrave;/g, 'ì')
                      .replace(/&iacute;/g, 'í')
                      .replace(/&icirc;/g, 'î')
                      .replace(/&iuml;/g, 'ï')
                      .replace(/&eth;/g, 'ð')
                      .replace(/&ntilde;/g, 'ñ')
                      .replace(/&ograve;/g, 'ò')
                      .replace(/&oacute;/g, 'ó')
                      .replace(/&ocirc;/g, 'ô')
                      .replace(/&otilde;/g, 'õ')
                      .replace(/&ouml;/g, 'ö')
                      .replace(/&oslash;/g, 'ø')
                      .replace(/&ugrave;/g, 'ù')
                      .replace(/&uacute;/g, 'ú')
                      .replace(/&ucirc;/g, 'û')
                      .replace(/&uuml;/g, 'ü')
                      .replace(/&yacute;/g, 'ý')
                      .replace(/&thorn;/g, 'þ')
                      .replace(/&yuml;/g, 'ÿ');
  }
  