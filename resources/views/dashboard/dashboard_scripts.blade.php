<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    
    const dashContainer = document.querySelector('#dashboard-container');
    window.addEventListener('load', () => {
        fetch('/dash-form')
            .then(response => response.text())
            .then(html => {
                dashContainer.innerHTML = html;
                cateForm();
                noticeForm();
                contactForm();
            })
            .catch(error => console.error('Error:', error));
    });

    const cateForm = () =>{
      const cateText = document.querySelector('#cate-link');
      cateText.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/cate-form')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cancelForm();
              cateChangeForm();
              cateEditForm();
              cateDeleteForm();
              cateForm2();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const cateChangeForm = () =>{
     if(document.querySelector('.cate-changebtn')){
      const btn = document.querySelector('.cate-changebtn');
      btn.addEventListener('click', () => {
        fetch('/cate-changeform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            }
        })
        .then(response => response.text())
        .then(html => {
          document.querySelector('.delete-modal').innerHTML = html;
          $("#sortable").sortable({
                update: function(event, ui) {
                    $(this).children().forEach(function(index) {
                        $(this).find('input[type="hidden"]').val(index);
                    });
                }
            });
          cancelModalForm();
        })
        .catch(error => console.error('Error:', error));
      });
     }
    };

    const cateEditForm = () =>{
      document.querySelectorAll('.cate-editbtn').forEach(function(btn) {
      btn.addEventListener('click', () => {
        let categoryName = btn.closest('.category-item').querySelector('.category-name').textContent;
        dashContainer.innerHTML = '';
        fetch('/cate-editform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({
                name: categoryName
            })
        })
        .then(response => response.text())
        .then(html => {
            dashContainer.innerHTML = html;
            cancelForm();
        })
        .catch(error => console.error('Error:', error));
      });
      });
    };

    const cateDeleteForm = () =>{
      document.querySelectorAll('.cate-deletebtn').forEach(function(btn) {
      btn.addEventListener('click', () => {
        let categoryName = btn.closest('.category-item').querySelector('.category-name').textContent;
        fetch('/cate-deleteform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({
                name: categoryName
            })
        })
        .then(response => response.text())
        .then(html => {
          document.querySelector('.delete-modal').innerHTML = html;
            cancelModalForm();
        })
        .catch(error => console.error('Error:', error));
      });
      });
    };

    const cateForm2 = () =>{
      const cateBtn = document.querySelector('#category-btn');
      cateBtn.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/cate-form2')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cancelForm();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const noticeForm = () =>{
      const noticeText = document.querySelector('#notice-link');
      noticeText.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/notice-form')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cancelForm();
              noticeSearch();
              noticeEditForm();
              noticeDeleteForm();
              noticeForm2();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const noticeSearch = () =>{
     const search = document.querySelector('.search-form');
      search.addEventListener('submit', (event) => {
       event.preventDefault();
       const formData = new FormData(search); 
       document.querySelector('.notice-content').innerHTML = '';
       fetch('/notices/search', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData 
       })
       .then(response => response.text())
       .then(html => {
           document.querySelector('.notice-content').innerHTML = html;
           cancelForm2();
           noticeEditForm();
           noticeDeleteForm();
           noticeForm2();
       })
       .catch(error => console.error('Error:', error));
      });
    };

    const noticeEditForm = () =>{
      document.querySelectorAll('.notice-editbtn').forEach(function(btn) {
      btn.addEventListener('click', () => {
        let noticeName = btn.closest('.notice-item').querySelector('.notice-name').textContent;
        dashContainer.innerHTML = '';
        fetch('/notice-editform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({
                name: noticeName
            })
        })
        .then(response => response.text())
        .then(html => {
            dashContainer.innerHTML = html;
            cancelForm();
            class MyUploadAdapter {
             constructor(loader, url) {
              this.loader = loader;
              this.url = url;
             }
             upload() {
              return this.loader.file
                  .then(file => new Promise((resolve, reject) => {
                      this._initRequest();
                      this._initListeners(resolve, reject, file);
                      this._sendRequest(file);
                  }));
             }
             abort() {
              if (this.xhr) {
                  this.xhr.abort();
              }
             }
             _initRequest() {
              const xhr = this.xhr = new XMLHttpRequest();
              xhr.open('POST', this.url, true);
              xhr.responseType = 'json';
              const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
             _initListeners(resolve, reject, file) {
              const xhr = this.xhr;
              const loader = this.loader;
              const genericErrorText = `Couldn't upload file: ${file.name}.`;

              xhr.addEventListener('error', () => reject(genericErrorText));
              xhr.addEventListener('abort', () => reject());
              xhr.addEventListener('load', () => {
                  const response = xhr.response;
                  if (!response || response.error) {
                      return reject(response && response.error ? response.error.message : genericErrorText);
                  }
                  resolve({
                      default: response.url
                  });
              });
              if (xhr.upload) {
                  xhr.upload.addEventListener('progress', evt => {
                      if (evt.lengthComputable) {
                          loader.uploadTotal = evt.total;
                          loader.uploaded = evt.loaded;
                      }
                  });
              }
             }
             _sendRequest(file) {
              const data = new FormData();
              data.append('upload', file);      
              this.xhr.send(data);
             }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader, '/image/upload'); 
                };
            }
            const editorElement = document.querySelector('#editor');
            if (editorElement) {
              CKEDITOR.ClassicEditor
                .create(editorElement, {
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'コンテンツはこちらから編集してください。',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            })
                    .catch(error => console.error(error));
            }
        })
        .catch(error => console.error('Error:', error));
      });
      });
    };

    const noticeDeleteForm = () =>{
      document.querySelectorAll('.notice-deletebtn').forEach(function(btn) {
      btn.addEventListener('click', () => {
        let noticeName = btn.closest('.notice-item').querySelector('.notice-name').textContent;
        fetch('/notice-deleteform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({
                name: noticeName
            })
        })
        .then(response => response.text())
        .then(html => {
          document.querySelector('.delete-modal').innerHTML = html;
            cancelModalForm();
        })
        .catch(error => console.error('Error:', error));
      });
      });
    };

    const noticeForm2 = () =>{
      const noticeBtn = document.querySelector('#notice-btn');
      noticeBtn.addEventListener('click', () => {
       dashContainer.innerHTML = '';
       fetch('/notice-form2')
           .then(response => response.text())
           .then(html => {
            dashContainer.innerHTML = html;
            cancelForm();
            class MyUploadAdapter {
             constructor(loader, url) {
              this.loader = loader;
              this.url = url;
             }
             upload() {
              return this.loader.file
                  .then(file => new Promise((resolve, reject) => {
                      this._initRequest();
                      this._initListeners(resolve, reject, file);
                      this._sendRequest(file);
                  }));
             }
             abort() {
              if (this.xhr) {
                  this.xhr.abort();
              }
             }
             _initRequest() {
              const xhr = this.xhr = new XMLHttpRequest();
              xhr.open('POST', this.url, true);
              xhr.responseType = 'json';
              const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
             _initListeners(resolve, reject, file) {
              const xhr = this.xhr;
              const loader = this.loader;
              const genericErrorText = `Couldn't upload file: ${file.name}.`;

              xhr.addEventListener('error', () => reject(genericErrorText));
              xhr.addEventListener('abort', () => reject());
              xhr.addEventListener('load', () => {
                  const response = xhr.response;
                  if (!response || response.error) {
                      return reject(response && response.error ? response.error.message : genericErrorText);
                  }
                  resolve({
                      default: response.url
                  });
              });
              if (xhr.upload) {
                  xhr.upload.addEventListener('progress', evt => {
                      if (evt.lengthComputable) {
                          loader.uploadTotal = evt.total;
                          loader.uploaded = evt.loaded;
                      }
                  });
              }
             }
             _sendRequest(file) {
              const data = new FormData();
              data.append('upload', file);      
              this.xhr.send(data);
             }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader, '/image/upload'); 
                };
            }
            const editorElement = document.querySelector('#editor');
            if (editorElement) {
              CKEDITOR.ClassicEditor
                .create(editorElement, {
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'ここにコンテンツを構築してください。',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            })
                    .catch(error => console.error(error));
            }
           })
           .catch(error => console.error('Error:', error));
      });
    };

    const contactForm = () =>{
      const contactText = document.querySelector('#contact-link');
      contactText.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/contact-form')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cancelForm();
              contactDeleteForm();
              contactForm2();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const contactForm2 = () =>{
        document.querySelectorAll('.contact-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const name = this.querySelector('.contact-name').textContent;
            const subject = this.querySelector('.contact-subject').textContent;
            fetch('/contact-detail', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ name, subject })
            })
            .then(response => response.text())
            .then(html => {
                document.querySelector('.delete-modal').innerHTML = html;
                cancelModalForm();
            })
            .catch(error => console.error('Error:', error));
        });
        });
    };

    const contactDeleteForm = () =>{
      document.querySelectorAll('.btn-delete').forEach(function(btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const contactItem = btn.closest('.contact-item');
        const name = contactItem.querySelector('.contact-name').textContent;
        const subject = contactItem.querySelector('.contact-subject').textContent;
        console.log(name);
        console.log(subject);
        fetch('/contact-deleteform', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({ name, subject })
        })
        .then(response => response.text())
        .then(html => {
          document.querySelector('.delete-modal').innerHTML = html;
            cancelModalForm();
        })
        .catch(error => console.error('Error:', error));
      });
      });
    };

    const cancelForm = () =>{
      const cancel = document.querySelector('.fa-xmark');
      cancel.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/dash-form')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cateForm();
              noticeForm();
              contactForm();
          })
          .catch(error => console.error('Error:', error));
      });
    }

    const cancelForm2 = () =>{
      const cancel = document.querySelector('.fa-xmark2');
      cancel.addEventListener('click', () => { 
        dashContainer.innerHTML = '';
        fetch('/notice-form')
          .then(response => response.text())
          .then(html => {
              dashContainer.innerHTML = html;
              cancelForm();
              noticeSearch();
              noticeEditForm();
              noticeDeleteForm();
              noticeForm2();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const cancelModalForm = () =>{
      const cancel = document.querySelector('.modal-xmark');
      cancel.addEventListener('click', () => {
        document.querySelector('.delete-modal').innerHTML = '';
      });
    }

  });
</script>


