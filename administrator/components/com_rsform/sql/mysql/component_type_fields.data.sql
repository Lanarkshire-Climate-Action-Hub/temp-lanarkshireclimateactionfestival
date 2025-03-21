DELETE FROM `#__rsform_component_type_fields` WHERE ComponentTypeId IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 41, 211, 212, 411, 355);
INSERT IGNORE INTO `#__rsform_component_type_fields` (`ComponentTypeId`, `FieldName`, `FieldType`, `FieldValues`, `Properties`, `Ordering`) VALUES
(1, 'NAME', 'textbox', '', '', 1),
(1, 'CAPTION', 'textbox', '', '', 2),
(1, 'REQUIRED', 'select', 'NO\r\nYES', '', 3),
(1, 'SIZE', 'textbox', '20', 'numeric', 4),
(1, 'MAXSIZE', 'textbox', '', 'numeric', 5),
(1, 'VALIDATIONRULE', 'select', '//<code>\r\nreturn RSFormProHelper::getValidationRules();\r\n//</code>', '', 6),
(1, 'VALIDATIONMULTIPLE', 'selectmultiple', '//<code>\r\nreturn RSFormProHelper::getValidationRules(false, true);\r\n//</code>', '', 7),
(1, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 8),
(1, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 8),
(1, 'DEFAULTVALUE', 'textarea', '', '', 9),
(1, 'PLACEHOLDER', 'textbox', '', '', 10),
(1, 'DESCRIPTION', 'textarea', '', '', 11),
(1, 'INPUTTYPE', 'select', 'text\r\nemail\r\ntel\r\nnumber\r\nrange\r\nurl', '{"case":{"number":{"show":["ATTRMIN","ATTRMAX","ATTRSTEP"],"hide":["MAXSIZE"]},"range":{"show":["ATTRMIN","ATTRMAX","ATTRSTEP"],"hide":["MAXSIZE"]},"text":{"show":["MAXSIZE"],"hide":["ATTRMIN","ATTRMAX","ATTRSTEP"]},"email":{"show":["MAXSIZE"],"hide":["ATTRMIN","ATTRMAX","ATTRSTEP"]},"tel":{"show":["MAXSIZE"],"hide":["ATTRMIN","ATTRMAX","ATTRSTEP"]},"url":{"show":["MAXSIZE"],"hide":["ATTRMIN","ATTRMAX","ATTRSTEP"]}}}', 0),
(1, 'ATTRMIN', 'textbox', '', 'float', 1),
(1, 'ATTRMAX', 'textbox', '', 'float', 2),
(1, 'ATTRSTEP', 'textbox', '1', 'float', 2),
(1, 'COMPONENTTYPE', 'hidden', '1', '', 15),
(1, 'VALIDATIONEXTRA', 'textbox', '', '', 8),
(2, 'NAME', 'textbox', '', '', 1),
(2, 'CAPTION', 'textbox', '', '', 2),
(2, 'REQUIRED', 'select', 'NO\r\nYES', '', 3),
(2, 'COLS', 'textbox', '50', 'textareasize', 4),
(2, 'ROWS', 'textbox', '5', 'textareasize', 5),
(2, 'VALIDATIONRULE', 'select', '//<code>\r\nreturn RSFormProHelper::getValidationRules();\r\n//</code>', '', 6),
(2, 'VALIDATIONMULTIPLE', 'selectmultiple', '//<code>\r\nreturn RSFormProHelper::getValidationRules(false, true);\r\n//</code>', '', 7),
(2, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(2, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 8),
(2, 'DEFAULTVALUE', 'textarea', '', '', 9),
(2, 'DESCRIPTION', 'textarea', '', '', 10),
(2, 'COMPONENTTYPE', 'hidden', '2', '', 10),
(2, 'PLACEHOLDER', 'textbox', '', '', 10),
(2, 'WYSIWYG', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["WYSIWYGBUTTONS"],"hide":["MAXSIZE","SHOW_CHAR_COUNT"]},"NO":{"show":["MAXSIZE","SHOW_CHAR_COUNT"],"hide":["WYSIWYGBUTTONS"]}}}', 11),
(2, 'WYSIWYGBUTTONS', 'select', 'NO\r\nYES', '', 12),
(2, 'MAXSIZE', 'textbox', '', 'numeric', 13),
(2, 'SHOW_CHAR_COUNT', 'select', 'NO\r\nYES', '', 14),
(2, 'VALIDATIONEXTRA', 'textbox', '', '', 8),
(3, 'NAME', 'textbox', '', '', 1),
(3, 'CAPTION', 'textbox', '', '', 2),
(3, 'SIZE', 'textbox', '', 'numeric', 3),
(3, 'MULTIPLE', 'select', 'NO\r\nYES', '', 4),
(3, 'ITEMS', 'textarea', '', '', 5),
(3, 'REQUIRED', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALIDATIONMESSAGE"],"hide":[]},"NO":{"show":[],"hide":["VALIDATIONMESSAGE"]}}}', 6),
(3, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 7),
(3, 'DESCRIPTION', 'textarea', '', '', 8),
(3, 'COMPONENTTYPE', 'hidden', '3', '', 10),
(3, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(4, 'NAME', 'textbox', '', '', 1),
(4, 'CAPTION', 'textbox', '', '', 2),
(4, 'ITEMS', 'textarea', '', '', 3),
(4, 'FLOW', 'select', 'HORIZONTAL\r\nVERTICAL\r\nVERTICAL2COLUMNS\r\nVERTICAL3COlUMNS\r\nVERTICAL4COLUMNS\r\nVERTICAL6COLUMNS', '', 4),
(4, 'MAXSELECTIONS', 'textbox', '0', '', 5),
(4, 'MINSELECTIONS', 'textbox', '0', '', 6),
(4, 'REQUIRED', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALIDATIONMESSAGE"],"hide":[]},"NO":{"show":[],"hide":["VALIDATIONMESSAGE"]}}}', 5),
(4, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 6),
(4, 'DESCRIPTION', 'textarea', '', '', 6),
(4, 'COMPONENTTYPE', 'hidden', '4', '', 7),
(4, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(5, 'NAME', 'textbox', '', '', 1),
(5, 'CAPTION', 'textbox', '', '', 2),
(5, 'ITEMS', 'textarea', '', '', 3),
(5, 'FLOW', 'select', 'HORIZONTAL\r\nVERTICAL\r\nVERTICAL2COLUMNS\r\nVERTICAL3COlUMNS\r\nVERTICAL4COLUMNS\r\nVERTICAL6COLUMNS', '', 4),
(5, 'REQUIRED', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALIDATIONMESSAGE"],"hide":[]},"NO":{"show":[],"hide":["VALIDATIONMESSAGE"]}}}', 5),
(5, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 6),
(5, 'DESCRIPTION', 'textarea', '', '', 6),
(5, 'COMPONENTTYPE', 'hidden', '5', '', 7),
(5, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(6, 'NAME', 'textbox', '', '', 1),
(6, 'CAPTION', 'textbox', '', '', 2),
(6, 'DEFAULTVALUE', 'textarea', '', '', 3),
(6, 'REQUIRED', 'select', 'NO\r\nYES', '', 4),
(6, 'VALIDATIONCALENDAR', 'select', '//<code>\r\nreturn RSFormProHelper::getOtherCalendars(6);\r\n//</code>', '{"case":{"":{"show":[],"hide":["VALIDATIONCALENDAROFFSET"]}},"indexcase":{"min":{"show":["VALIDATIONCALENDAROFFSET"],"hide":[]},"max":{"show":["VALIDATIONCALENDAROFFSET"],"hide":[]}}}', 4),
(6, 'VALIDATIONCALENDAROFFSET', 'textbox', '1', 'numeric', 5),
(6, 'VALIDATIONDATE', 'select', 'YES\r\nNO', '', 8),
(6, 'DATEFORMAT', 'textbox', 'd-m-Y', '', 4),
(6, 'CALENDARLAYOUT', 'select', 'FLAT\r\nPOPUP', '{"case":{"POPUP":{"show":["READONLY", "POPUPLABEL", "ALLOWHTML","PLACEHOLDER"],"hide":[]},"FLAT":{"show":[],"hide":["READONLY", "POPUPLABEL", "ALLOWHTML","PLACEHOLDER"]}}}', 5),
(6, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 6),
(6, 'DESCRIPTION', 'textarea', '', '', 7),
(6, 'COMPONENTTYPE', 'hidden', '6', '', 8),
(6, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(6, 'READONLY', 'select', 'NO\r\nYES', '', 6),
(6, 'POPUPLABEL', 'textbox', '...', '', 7),
(6, 'ALLOWHTML', 'select', 'NO\nYES', '', 8),
(6, 'PLACEHOLDER', 'textbox', '', '', 9),
(6, 'MINDATE', 'textarea', '', '', 5),
(6, 'MAXDATE', 'textarea', '', '', 5),
(7, 'NAME', 'textbox', '', '', 1),
(7, 'CAPTION', 'textbox', '', '', 3),
(7, 'LABEL', 'textbox', '', '', 2),
(7, 'RESET', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["RESETLABEL"],"hide":[]},"NO":{"show":[],"hide":["RESETLABEL"]}}}', 4),
(7, 'RESETLABEL', 'textbox', '', '', 5),
(7, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 6),
(7, 'DESCRIPTION', 'textarea', '', '', 7),
(7, 'COMPONENTTYPE', 'hidden', '7', '', 8),
(7, 'BUTTONTYPE', 'select', 'TYPEBUTTON\nTYPEINPUT', '{"case":{"TYPEBUTTON":{"show":["ALLOWHTML"],"hide":[]},"TYPEINPUT":{"show":[],"hide":["ALLOWHTML"]}}}', 6),
(7, 'ALLOWHTML', 'select', 'NO\nYES', '', 7),
(8, 'NAME', 'textbox', '', '', 1),
(8, 'CAPTION', 'textbox', '', '', 2),
(8, 'LENGTH', 'textbox', '4', '', 3),
(8, 'BACKGROUNDCOLOR', 'textbox', '#FFFFFF', '', 4),
(8, 'TEXTCOLOR', 'textbox', '#000000', '', 5),
(8, 'TYPE', 'select', 'ALPHA\r\nNUMERIC\r\nALPHANUMERIC', '', 6),
(8, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 7),
(8, 'DESCRIPTION', 'textarea', '', '', 9),
(8, 'COMPONENTTYPE', 'hidden', '8', '', 9),
(8, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(8, 'FLOW', 'select', 'VERTICAL\r\nHORIZONTAL', '', 7),
(8, 'SHOWREFRESH', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["REFRESHTEXT"],"hide":[]},"NO":{"show":[],"hide":["REFRESHTEXT"]}}}', 8),
(8, 'REFRESHTEXT', 'textbox', 'REFRESH', '', 11),
(8, 'SIZE', 'textbox', '15', 'numeric', 12),
(8, 'IMAGETYPE', 'select', 'FREETYPE\r\nNOFREETYPE\r\nINVISIBLE', '{"case":{"FREETYPE":{"show":["BACKGROUNDCOLOR","TEXTCOLOR","TYPE","FLOW","LENGTH","SHOWREFRESH","REFRESHTEXT","SIZE"],"hide":[]},"NOFREETYPE":{"show":["BACKGROUNDCOLOR","TEXTCOLOR","TYPE","FLOW","LENGTH","SHOWREFRESH","REFRESHTEXT","SIZE"],"hide":[]},"INVISIBLE":{"show":[],"hide":["BACKGROUNDCOLOR","TEXTCOLOR","TYPE","FLOW","LENGTH","SHOWREFRESH","REFRESHTEXT","SIZE"]}}}', 3),
(9, 'NAME', 'textbox', '', '', 1),
(9, 'CAPTION', 'textbox', '', '', 2),
(9, 'REQUIRED', 'select', 'NO\r\nYES', '', 3),
(9, 'FILESIZE', 'textbox', '', 'numeric', 0),
(9, 'DESTINATION', 'textbox', '//<code>\r\nreturn ''components/com_rsform/uploads/'';\r\n//</code>', '', 1),
(9, 'MULTIPLE', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["FILESSEPARATOR","MINFILES","MAXFILES","MULTIPLEPLUS"],"hide":[]},"NO":{"show":[],"hide":["FILESSEPARATOR","MINFILES","MAXFILES","MULTIPLEPLUS"]}}}', 2),
(9, 'MULTIPLEPLUS', 'select', 'NO\r\nYES', '', 3),
(9, 'MINFILES', 'textbox', '1', 'numeric', 4),
(9, 'MAXFILES', 'textbox', '0', 'numeric', 5),
(9, 'FILESSEPARATOR', 'textbox', '<br />', '', 6),
(9, 'ACCEPTEDFILES', 'textarea', '', 'oneperline', 7),
(9, 'ACCEPTEDFILESIMAGES', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["THUMBSIZE","THUMBQUALITY","SHOWIMAGEPREVIEW","THUMBEXTENSION"],"hide":["ACCEPTEDFILES"]},"NO":{"show":["ACCEPTEDFILES"],"hide":["THUMBSIZE","THUMBQUALITY","SHOWIMAGEPREVIEW","THUMBEXTENSION"]}}}', 7),
(9, 'SHOWIMAGEPREVIEW', 'select', 'NO\r\nYES', '', 8),
(9, 'THUMBSIZE', 'textbox', '220', 'numeric', 9),
(9, 'THUMBQUALITY', 'textbox', '75', 'numeric', 10),
(9, 'THUMBEXTENSION', 'select', 'jpg\r\npng\r\nwebp', '', 11),
(9, 'SANITIZEFILENAME', 'select', 'NO\r\nYES', '', 101),
(9, 'ADDITIONALATTRIBUTES', 'textarea', '', '',7),
(9, 'DESCRIPTION', 'textarea', '', '', 8),
(9, 'COMPONENTTYPE', 'hidden', '9', '', 9),
(9, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(9, 'PREFIX', 'textarea', '', '', 102),
(9, 'EMAILATTACH', 'selectmultiple', '//<code>\r\nreturn RSFormProHelper::getEmailAttachOptions();\r\n//</code>', '', 103),
(10, 'NAME', 'textbox', '', '', 1),
(10, 'TEXT', 'textarea', '', '', 1),
(10, 'COMPONENTTYPE', 'hidden', '10', '', 9),
(11, 'NAME', 'textbox', '', '', 1),
(11, 'DEFAULTVALUE', 'textarea', '', '', 2),
(11, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 1),
(11, 'COMPONENTTYPE', 'hidden', '11', '', 9),
(13, 'NAME', 'textbox', '', '', 1),
(13, 'CAPTION', 'textbox', '', '', 3),
(13, 'LABEL', 'textbox', '', '', 2),
(13, 'RESET', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["RESETLABEL"],"hide":[]},"NO":{"show":[],"hide":["RESETLABEL"]}}}', 6),
(13, 'RESETLABEL', 'textbox', '', '', 7),
(13, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 9),
(13, 'COMPONENTTYPE', 'hidden', '13', '', 12),
(13, 'BUTTONTYPE', 'select', 'TYPEBUTTON\nTYPEINPUT', '{"case":{"TYPEBUTTON":{"show":["ALLOWHTML"],"hide":[]},"TYPEINPUT":{"show":[],"hide":["ALLOWHTML"]}}}', 11),
(13, 'ALLOWHTML', 'select', 'NO\nYES', '', 12),
(13, 'PREVBUTTON', 'textbox', '< Prev', '', 8),
(13, 'DISPLAYPROGRESS', 'select', 'NO\r\nAUTO\r\nYES', '{"case":{"YES":{"show":["DISPLAYPROGRESSMSG"],"hide":[]},"NO":{"show":[],"hide":["DISPLAYPROGRESSMSG"]}, "AUTO":{"show":[],"hide":["DISPLAYPROGRESSMSG"]}}}', 9),
(13, 'DISPLAYPROGRESSMSG', 'textarea', '<div>\r\n <p><em>Page <strong>{page}</strong> of {total}</em></p>\r\n <div class="rsformProgressContainer">\r\n  <div class="rsformProgressBar" style="width: {percent}%;"></div>\r\n </div>\r\n</div>', '', 10),
(14, 'NAME', 'textbox', '', '', 1),
(14, 'CAPTION', 'textbox', '', '', 2),
(14, 'REQUIRED', 'select', 'NO\r\nYES', '', 3),
(14, 'SIZE', 'textbox', '', 'numeric', 4),
(14, 'MAXSIZE', 'textbox', '', 'numeric', 5),
(14, 'DEFAULTVALUE', 'textarea', '', '', 6),
(14, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 7),
(14, 'COMPONENTTYPE', 'hidden', '14', '', 8),
(14, 'DESCRIPTION', 'textarea', '', '', 100),
(14, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 100),
(14, 'VALIDATIONRULE', 'select', '//<code>\r\nreturn RSFormProHelper::getValidationRules();\r\n//</code>', '', 9),
(14, 'VALIDATIONMULTIPLE', 'selectmultiple', '//<code>\r\nreturn RSFormProHelper::getValidationRules(false, true);\r\n//</code>', '', 10),
(14, 'PLACEHOLDER', 'textbox', '', '', 10),
(14, 'VALIDATIONEXTRA', 'textbox', '', '', 11),
(15, 'NAME', 'textbox', '', '', 1),
(15, 'LENGTH', 'textbox', '8', '', 4),
(15, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 7),
(15, 'COMPONENTTYPE', 'hidden', '15', '', 8),
(15, 'CHARACTERS', 'select', 'ALPHANUMERIC\r\nALPHA\r\nNUMERIC', '', 3),
(15, 'TICKETTYPE', 'select', 'RANDOM\r\nSEQUENTIAL', '{"case":{"RANDOM":{"show":["CHARACTERS", "LENGTH"],"hide":["LEADINGZEROLENGTH"]},"SEQUENTIAL":{"show":["LEADINGZEROLENGTH"],"hide":["CHARACTERS", "LENGTH"]}}}', 2),
(15, 'LEADINGZEROLENGTH', 'select', '0\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10', '', 5),
(41, 'NAME', 'textbox', '', '', 1),
(41, 'COMPONENTTYPE', 'hidden', '41', '', 5),
(41, 'NEXTBUTTON', 'textbox', 'Next >', '', 2),
(41, 'PREVBUTTON', 'textbox', '< Prev', '', 3),
(41, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 4),
(41, 'VALIDATENEXTPAGE', 'select', 'NO\r\nYES', '', 5),
(41, 'DISPLAYPROGRESS', 'select', 'NO\r\nAUTO\r\nYES', '{"case":{"YES":{"show":["DISPLAYPROGRESSMSG"],"hide":[]},"NO":{"show":[],"hide":["DISPLAYPROGRESSMSG"]}, "AUTO":{"show":[],"hide":["DISPLAYPROGRESSMSG"]}}}', 6),
(41, 'DISPLAYPROGRESSMSG', 'textarea', '<div>\r\n <p><em>Page <strong>{page}</strong> of {total}</em></p>\r\n <div class="rsformProgressContainer">\r\n  <div class="rsformProgressBar" style="width: {percent}%;"></div>\r\n </div>\r\n</div>', '', 7),
(41, 'BUTTONTYPE', 'select', 'TYPEBUTTON\nTYPEINPUT', '{"case":{"TYPEBUTTON":{"show":["ALLOWHTML"],"hide":[]},"TYPEINPUT":{"show":[],"hide":["ALLOWHTML"]}}}', 8),
(41, 'ALLOWHTML', 'select', 'NO\nYES', '', 9),
(211, 'VALIDATION_ALLOW_INCORRECT_DATE', 'select', 'NO\r\nYES', '', 0),
(211, 'NAME', 'textbox', '', '', 1),
(211, 'VALIDATIONRULE_DATE', 'select', '//<code>\r\nreturn RSFormProHelper::getDateValidationRules();\r\n//</code>', '', 1),
(211, 'CAPTION', 'textbox', '', '', 2),
(211, 'DESCRIPTION', 'textarea', '', '', 3),
(211, 'REQUIRED', 'select', 'NO\r\nYES', '', 4),
(211, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 5),
(211, 'DATEORDERING', 'select', 'DMY\r\nMDY\r\nYMD\r\nYDM\r\nMYD\r\nDYM', '', 6),
(211, 'DATESEPARATOR', 'textbox', ' / ', '', 7),
(211, 'SHOWDAY', 'select', 'YES\r\nNO', '{"case":{"YES":{"show":["SHOWDAYPLEASE" ,"SHOWDAYTYPE"],"hide":[]},"NO":{"show":[],"hide":["SHOWDAYPLEASE" ,"SHOWDAYTYPE"]}}}', 8),
(211, 'SHOWDAYPLEASE', 'textbox', 'Day', '', 9),
(211, 'SHOWDAYTYPE', 'select', 'DAY_TYPE_01\r\nDAY_TYPE_1', '', 10),
(211, 'SHOWMONTH', 'select', 'YES\r\nNO', '{"case":{"YES":{"show":["SHOWMONTHPLEASE" ,"SHOWMONTHTYPE"],"hide":[]},"NO":{"show":[],"hide":["SHOWMONTHPLEASE" ,"SHOWMONTHTYPE"]}}}', 11),
(211, 'SHOWMONTHPLEASE', 'textbox', 'Month', '', 12),
(211, 'SHOWMONTHTYPE', 'select', 'MONTH_TYPE_01\r\nMONTH_TYPE_1\r\nMONTH_TYPE_TEXT_SHORT\r\nMONTH_TYPE_TEXT_LONG', '', 13),
(211, 'SHOWYEAR', 'select', 'YES\r\nNO', '{"case":{"YES":{"show":["SHOWYEARPLEASE" ,"STARTYEAR", "ENDYEAR"],"hide":[]},"NO":{"show":[],"hide":["SHOWYEARPLEASE" ,"STARTYEAR", "ENDYEAR"]}}}', 14),
(211, 'SHOWYEARPLEASE', 'textbox', 'Year', '', 15),
(211, 'STARTYEAR', 'textbox', '1960', '', 16),
(211, 'ENDYEAR', 'textbox', '2022', '', 17),
(211, 'STORELEADINGZERO', 'select', 'NO\r\nYES', '', 18),
(211, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 18),
(211, 'COMPONENTTYPE', 'hidden', '211', '', 19),
(212, 'NAME', 'textbox', '', '', 0),
(212, 'CAPTION', 'textbox', '', '', 1),
(212, 'DESCRIPTION', 'textarea', '', '', 3),
(212, 'REQUIRED', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALIDATIONMESSAGE"],"hide":[]},"NO":{"show":[],"hide":["VALIDATIONMESSAGE"]}}}', 4),
(212, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 5),
(212, 'DEFAULTVALUE', 'textarea', '', '', 2),
(212, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 6),
(212, 'MAPWIDTH', 'textbox', '450px', '', 7),
(212, 'MAPHEIGHT', 'textbox', '300px', '', 8),
(212, 'REQUESTLOCATION', 'select', 'NO\r\nYES', '', 9),
(212, 'MAPCENTER', 'textbox', '39.5500507,-105.7820674', '', 9),
(212, 'COMPONENTTYPE', 'hidden', '212', '', 12),
(212, 'SIZE', 'textbox', '20', 'numeric', 13),
(212, 'MAPZOOM', 'textbox', '10', 'numeric', 10),
(212, 'MAPRESULT', 'select', 'ADDRESS\r\nCOORDINATES', '', 12),
(212, 'MAPTYPE', 'select', 'ROADMAP\r\nSATELLITE\r\nHYBRID\r\nTERRAIN', '', 13),
(212, 'GEOLOCATION', 'select', 'NO\r\nYES', '', 11),
(411, 'NAME', 'textbox', '', '', 1),
(411, 'CAPTION', 'textbox', '', '', 2),
(411, 'DEFAULTVALUE', 'textarea', '', '', 3),
(411, 'DESCRIPTION', 'textarea', '', '', 4),
(411, 'REQUIRED', 'select', 'NO\r\nYES', '', 5),
(411, 'VALIDATIONCALENDAR', 'select', '//<code>\nreturn RSFormProHelper::getOtherCalendars(411);\n//</code>', '{"case":{"":{"show":[],"hide":["VALIDATIONCALENDAROFFSET"]}},"indexcase":{"min":{"show":["VALIDATIONCALENDAROFFSET"],"hide":[]},"max":{"show":["VALIDATIONCALENDAROFFSET"],"hide":[]}}}', 6),
(411, 'VALIDATIONCALENDAROFFSET', 'textbox', '1', 'numeric', 7),
(411, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 8),
(411, 'VALIDATIONDATE', 'select', 'YES\r\nNO', '', 9),
(411, 'DATEFORMAT', 'textbox', 'd-m-Y H:i', '', 8),
(411, 'MINDATEJQ', 'textarea', '', '', 9),
(411, 'MAXDATEJQ', 'textarea', '', '', 10),
(411, 'ALLOWDATERE', 'textbox', '', '', 11),
(411, 'ALLOWDATES', 'textarea', '', '', 12),
(411, 'TIMEPICKER', 'select', 'YES\r\nNO', '{"case":{"YES":{"show":["TIMEPICKERFORMAT", "TIMESTEP","MINTIMEJQ", "MAXTIMEJQ"],"hide":[]},"NO":{"show":[],"hide":["TIMEPICKERFORMAT", "TIMESTEP","MINTIMEJQ", "MAXTIMEJQ"]}}}', 13),
(411, 'TIMEPICKERFORMAT', 'textbox', 'H:i', '', 14),
(411, 'TIMESTEP', 'textbox', '30', '', 15),
(411, 'MINTIMEJQ', 'textarea', '', '', 16),
(411, 'MAXTIMEJQ', 'textarea', '', '', 17),
(411, 'ADDITIONALATTRIBUTES', 'textarea', '', '', 18),
(411, 'CALENDARLAYOUT', 'select', 'FLAT\r\nPOPUP', '{"case":{"POPUP":{"show":["READONLY", "POPUPLABEL", "ALLOWHTML","PLACEHOLDER"],"hide":[]},"FLAT":{"show":[],"hide":["READONLY", "POPUPLABEL", "ALLOWHTML","PLACEHOLDER"]}}}', 19),
(411, 'READONLY', 'select', 'NO\r\nYES', '', 20),
(411, 'POPUPLABEL', 'textbox', '...', '', 21),
(411, 'ALLOWHTML', 'select', 'NO\nYES', '', 22),
(411, 'THEME', 'select', 'DEFAULT\r\nDARK', '', 23),
(411, 'PLACEHOLDER', 'textbox', '', '', 24),
(411, 'COMPONENTTYPE', 'hidden', '411', '', 200),
(355, 'NAME', 'textbox', '', '', 1),
(355, 'CAPTION', 'textbox', '', '', 2),
(355, 'DEFAULTVALUE', 'textarea', '', '', 3),
(355, 'DESCRIPTION', 'textarea', '', '', 4),
(355, 'REQUIRED', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALIDATIONMESSAGE"],"hide":[]},"NO":{"show":[],"hide":["VALIDATIONMESSAGE"]}}}', 5),
(355, 'VALIDATIONMESSAGE', 'textarea', 'INVALIDINPUT', '', 6),
(355, 'SLIDERTYPE', 'select', 'SINGLE\r\nDOUBLE', '{"case":{"SINGLE":{"show":[],"hide":["FROMFIXED","TOFIXED"]},"DOUBLE":{"show":["FROMFIXED","TOFIXED"],"hide":[]}}}', 7),
(355, 'SKIN', 'select', 'FLAT\r\nHTML5\r\nMODERN\r\nNICE\r\nSIMPLE', '', 8),
(355, 'USEVALUES', 'select', 'NO\r\nYES', '{"case":{"YES":{"show":["VALUES"],"hide":["MINVALUE", "MAXVALUE", "GRIDSNAP", "GRIDSTEP"]},"NO":{"show":["MINVALUE", "MAXVALUE", "GRIDSNAP", "GRIDSTEP"],"hide":["VALUES"]}}}', 9),
(355, 'VALUES', 'textarea', '', '', 10),
(355, 'MINVALUE', 'textbox', '0', 'numeric', 11),
(355, 'MAXVALUE', 'textbox', '100', 'numeric', 12),
(355, 'GRID', 'select', 'YES\r\nNO', '', 13),
(355, 'GRIDSNAP', 'select', 'NO\r\nYES', '', 14),
(355, 'GRIDSTEP', 'textbox', '10', 'numeric', 15),
(355, 'FORCEEDGES', 'select', 'YES\r\nNO', '', 16),
(355, 'FROMFIXED', 'select', 'NO\r\nYES', '', 17),
(355, 'TOFIXED', 'select', 'NO\r\nYES', '', 18),
(355, 'KEYBOARD', 'select', 'NO\r\nYES', '', 19),
(355, 'READONLY', 'select', 'NO\r\nYES', '', 20),
(355, 'COMPONENTTYPE', 'hidden', '355', '', 21);
