// Function that will allow us to know if Ajax uploads are supported
          function supportAjaxUploadWithProgress() {
            return supportFileAPI() && supportAjaxUploadProgressEvents() && supportFormData();

            // Is the File API supported?
            function supportFileAPI() {
              var fi = document.createElement('INPUT');
              fi.type = 'file';
              return 'files' in fi;
            };

            // Are progress events supported?
            function supportAjaxUploadProgressEvents() {
              var xhr = new XMLHttpRequest();
              return !! (xhr && ('upload' in xhr) && ('onprogress' in xhr.upload));
            };

            // Is FormData supported?
            function supportFormData() {
              return !! window.FormData;
            }
          }

          // Actually confirm support
          //if (supportAjaxUploadWithProgress()) {
            // Ajax uploads are supported!
            // Change the support message and enable the upload button
            //var notice = document.getElementById('support-notice');
           // var uploadBtn = document.getElementById('upload-button-id');
           // notice.innerHTML = "点击下面的按钮选择将要上传的语音(文件大小小于2MB，格式为mp3)";
           // uploadBtn.removeAttribute('disabled');

            // Init the Ajax form submission
            // initFullFormAjaxUpload();

            // Init the single-field file upload
            // initFileOnlyAjaxUpload();
          //}

          function initFullFormAjaxUpload() {
            var form = document.getElementById('form-id');
            form.onsubmit = function() {
              // FormData receives the whole form
              var formData = new FormData(form);

              // We send the data where the form wanted
              var action = form.getAttribute('action');

              // Code common to both variants
              sendXHRequest(formData, action);

              // Avoid normal form submission
              return false;
            }
          }
              // Once the FormData instance is ready and we know
              // where to send the data, the code is the same
              // for both variants of this technique
              function sendXHRequest(formData, uri) {
                // Get an XMLHttpRequest instance
                var xhr = new XMLHttpRequest();

                // Set up events
                xhr.upload.addEventListener('loadstart', onloadstartHandler, false);
                xhr.upload.addEventListener('progress', onprogressHandler, false);
                xhr.upload.addEventListener('load', onloadHandler, false);
                xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);

                // Set up request
                xhr.open('POST', uri, true);

                // Fire!
                xhr.send(formData);
              }
              // Handle the start of the transmission
               function onloadstartHandler(evt) {
                 var div = document.getElementById('upload-status');
                 // div.innerHTML = 'Upload started!';
               }

               // Handle the end of the transmissionS
               function onloadHandler(evt) {
                 var div = document.getElementById('upload-status');
                 // div.innerHTML = '上传成功!';
               }

               // Handle the progress
               function onprogressHandler(evt) {
                 var div = document.getElementById('progress');
                 var percent = evt.loaded/evt.total*100;
                 div.innerHTML = '进度: ' + percent + '%';
               }

               // Handle the response from the server
               function onreadystatechangeHandler(evt) {
                 var status = null;

                 try {
                   status = evt.target.status;
                 }
                 catch(e) {
                   return;
                 }

                 if (status == '200' && evt.target.responseText) {
                   alert(evt.target.responseText);
                 }
               }