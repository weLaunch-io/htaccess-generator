/*global jQuery */
(function(){
  
    // USE STRICT
    "use strict";

    var htaccess = {

        init : function () {
            // Basic variables
            htaccess.url = location.href;
            htaccess.baseURL = htaccess.url.substring(0, htaccess.url.indexOf('/', 14));
            htaccess.pathname = location.pathname;
            htaccess.pathSplit = htaccess.pathname.split("/");
            htaccess.lang = htaccess.pathSplit[1];
            htaccess.firstPath = htaccess.pathSplit[2];
            htaccess.title = document.title;

            // Start the engine
            htaccess.htaccessForm();
            htaccess.switchLanguage();
            htaccess.updateMyHtaccessesCount();
            htaccess.showPopovers();
        },
        htaccessForm : function() {
            var htaccessForm = {
                errorPages : function() {
                    var addErrorPage = $('#addErrorPage');
                    var removeErrorPage = $('#removeErrorPage');

                    addErrorPage.on("click", function(e){
                        e.preventDefault();
                        var errorPageRow = $(".errorPageRow");
                        var firstErrorPageRow = errorPageRow.first();
                        var lastErrorPageRow = errorPageRow.last();
                        var clone = firstErrorPageRow.clone();
                        clone.find('input').val('');

                        lastErrorPageRow.after(clone);
                    });

                    removeErrorPage.on("click", function(e){
                        e.preventDefault();
                        var errorPageRow = $(".errorPageRow");
                        if(errorPageRow.length > 1){
                        errorPageRow.last().remove();
                    }
                    });
                },
                customRewriteRules : function() {
                    var addCustomRewriteRule = $('#addCustomRewriteRule');
                    var removeCustomRewriteRule = $('#removeCustomRewriteRule');

                    addCustomRewriteRule.on("click", function(e){
                        e.preventDefault();
                        var customRewriteruleRow = $(".customRewriteruleRow");
                        var firstCustomRewriteruleRow = customRewriteruleRow.first();
                        var lastCustomRewriteruleRow = customRewriteruleRow.last();
                        var clone = firstCustomRewriteruleRow.clone();
                        clone.find('input').val('');

                        lastCustomRewriteruleRow.after(clone);
                    });

                    removeCustomRewriteRule.on("click", function(e){
                        e.preventDefault();
                        var customRewriteruleRow = $(".customRewriteruleRow");
                        if(customRewriteruleRow.length > 1){
                        customRewriteruleRow.last().remove();
                    }
                    });
                },
                expiration : function() {
                    var addExpiration = $('#addExpiration');
                    var removeExpiration = $('#removeExpiration');

                    addExpiration.on("click", function(e){
                        e.preventDefault();
                        var expirationRow = $(".expirationRow");
                        var firstExpirationRow = expirationRow.first();
                        var lastExpirationRow = expirationRow.last();
                        var clone = firstExpirationRow.clone();
                        clone.find('input').val('');

                        lastExpirationRow.after(clone);
                    });

                    removeExpiration.on("click", function(e){
                        e.preventDefault();
                        var expirationRow = $(".expirationRow");
                        if(expirationRow.length > 1){
                        expirationRow.last().remove();
                    }
                    });
                },
                user : function() {
                    var addUser = $('#addUser');
                    var removeUser = $('#removeUser');

                    addUser.on("click", function(e){
                        e.preventDefault();
                        var userRow = $(".userRow");
                        var firstUserRow = userRow.first();
                        var lastUserRow = userRow.last();
                        var clone = firstUserRow.clone();
                        clone.find('input').val('');

                        lastUserRow.after(clone);
                        htaccessForm.htpasswd();
                    });

                    removeUser.on("click", function(e){
                        e.preventDefault();
                        var userRow = $(".userRow");
                        if(userRow.length > 1){
                            userRow.last().remove();
                        }
                        htaccessForm.htpasswd();
                    });
                },
                htpasswd : function(){
                    var htpasswdChange = $('.htpasswdChange');
                    var yourHtpasswd = $('#htpasswd');

                    htpasswdChange.on('change', function(){
                        var formData = form.serialize();
                        var request;

                        request = $.ajax({
                            url: 'http://htaccess.db-dzine.de/get-htpasswd/',
                            type: 'POST',
                            data: formData,
                            dataType: 'json'
                        });
                        request.done(function (response, textStatus, jqXHR){
                            yourHtpasswd.html(response);
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown){
                            console.log(jqXHR);
                            console.log(textStatus);
                        });
                    });
                },
                formChange : function() {
                    var yourHtaccessModalBody = $('#yourHtaccessModalBody');

                    form.on('change', function(){
                        var formData = $(this).serialize();
                        var request;

                        request = $.ajax({
                            url: 'http://htaccess.db-dzine.de/get-htaccess/',
                            type: 'POST',
                            data: formData,
                            dataType: 'json'
                        });
                        request.done(function (response, textStatus, jqXHR){
                            // console.log(response);
                            yourHtaccessModalBody.html(response);
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown){
                            console.log(jqXHR);
                            console.log(textStatus);
                        });
                    });
                },
                saveHtaccess : function() {
                    var saveElement = $('.saveHtaccess');
                    var yourHtaccessModalBody;

                    saveElement.on('click', function(e){
                        e.preventDefault();
                        var request;
                        var saveName = prompt('Name your htaccess');

                        if(saveName === null || saveName === "") {
                            return false;
                        }

                        // var formData = new FormData($('#htaccessForm')[0]);
                        // formData.append('name', saveName);

                        var formData = form.serialize();
                        
                        formData += '&name='+saveName;
                        console.log(formData);
                        request = $.ajax({
                            url: 'http://htaccess.db-dzine.de/save-htaccess/',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            // processData: false,
                            // contentType: false
                        });
                        request.done(function (response, textStatus, jqXHR){
                            new PNotify({
                                title: response.title,
                                text: response.text,
                                type: 'success'
                            });
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown){
                            console.log(jqXHR);
                            console.log(textStatus);
                        });                        
                    });
                },
                downloadHtaccess : function() {
                    var downloadElement = $('.downloadHtaccess');
                    var yourHtaccessModalBody;   

                    downloadElement.on('click', function(e){
                        e.preventDefault();

                        yourHtaccessModalBody = $('#yourHtaccessModalBody');   
                        var data = {};
                        var request;

                        data.csrf_token = csrf_token;
                        data.htaccess = yourHtaccessModalBody.html();
                        console.log(data);
                        request = $.ajax({
                            url: 'http://htaccess.db-dzine.de/tmp/get-htaccess-download-link/',
                            type: 'POST',
                            data: data,
                            dataType: 'json'
                        });
                        request.done(function (response, textStatus, jqXHR){
                            new PNotify({
                                title: response.title,
                                text: response.text,
                                type: 'success'
                            });
                            $("body").append("<iframe src='/tmp/download-htaccess/?id=" + response.id+ "' style='display: none;' ></iframe>");
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown){
                            console.log(jqXHR);
                            console.log(textStatus);
                        });
                    });
                },
                copyToClipboard : function() {
                    var copyButton = $('.copyHtaccess');
                    var clip = new ZeroClipboard(copyButton);
                    var yourHtaccessModalBody = $('#yourHtaccessModalBody');
                    clip.on("aftercopy", function(event){
                        new PNotify({
                            title: 'Copy successfull',
                            text: 'You can now paste it.',
                            type: 'success'
                        });
                    });
                },
                resetHtaccessForm : function() {
                    var resetElement = $('.resetHtaccessForm');

                    resetElement.on('click', function(e){
                        e.preventDefault();
                        form.get(0).reset();
                        form.trigger('change');
                    });
                }
            };

            if(htaccess.firstPath === "new-htaccess") {
                var form = $('#htaccessForm');
                var datePicker = $('.date');
    
                form.validationEngine();
                htaccessForm.errorPages();
                htaccessForm.customRewriteRules();
                htaccessForm.expiration();
                htaccessForm.user();
                htaccessForm.htpasswd();
                htaccessForm.formChange();
                htaccessForm.saveHtaccess();
                htaccessForm.downloadHtaccess();
                htaccessForm.resetHtaccessForm();
                htaccessForm.copyToClipboard();
                form.trigger('change');
            }
        },
        showPopovers :function() {
            var popovers = $('[data-toggle="popover"]');

            popovers.popover({trigger: 'hover', html: true});
        },
        switchLanguage : function() {
            var languageSelect = $('select[name="language"]');
            var pathSplit = this.pathSplit;

            // on change 
            languageSelect.change(function(){
                var lang = $(this).find(':selected').val();
                pathSplit[1] = lang;
                var newUrl = pathSplit.join("/");

                window.location.href = htaccess.baseURL+newUrl;
            });
        },
        updateMyHtaccessesCount : function() {
            var request;
            var data = {};
            var badges = $('.badge');

            data.csrf_token = csrf_token;
            request = $.ajax({
                url: 'http://htaccess.db-dzine.de/my-htaccesses/',
                type: 'POST',
                data: data,
                dataType: 'json'
            });
            request.done(function (response, textStatus, jqXHR){
                badges.html(response);
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
            });
        }
    };

    jQuery(document).ready(htaccess.init);

})(jQuery);