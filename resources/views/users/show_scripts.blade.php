<script>
document.addEventListener('DOMContentLoaded', () => {
    fetch('/CMS/{{ $user->name }}/list-content', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.text()) 
    .then(html => {
        document.querySelector('.show-content').innerHTML = html;
        nextListForm1();
        noticeItemForm();
    })
    .catch(error => console.error('Error:', error));
});

const nextListForm1 = () =>{
  if(document.querySelector('.notice-more')){
    const nextPage = document.querySelector('.notice-more');
    nextPage.addEventListener('click', () => { 
      const currentPage = parseInt(nextPage.getAttribute('data-page'));
      document.querySelector('.show-content').innerHTML = '';
      fetch(`/CMS/{{ $user->name }}/next-listform?page=${currentPage}`)
      .then(response => response.text())
      .then(html => {
        document.querySelector('.show-content').innerHTML = html;
        nextListForm2();
        backListForm1();
        noticeItemForm();
      })
      .catch(error => console.error('Error:', error));
    });
}
};

const nextListForm2 = () =>{
  if(document.querySelector('.notice-more')){
    const nextPage = document.querySelector('.notice-more');
    nextPage.addEventListener('click', () => { 
      const currentPage = parseInt(nextPage.getAttribute('data-page'));
      document.querySelector('.show-content').innerHTML = '';
      fetch(`/CMS/{{ $user->name }}/next-listform?page=${currentPage}`)
      .then(response => response.text())
      .then(html => {
        document.querySelector('.show-content').innerHTML = html;
        nextListForm1();
        backListForm1();
        noticeItemForm();
      })
      .catch(error => console.error('Error:', error));
    });
}
};

const backListForm1 = () =>{
  if(document.querySelector('.notice-previous')){
      const backPage = document.querySelector('.notice-previous');
      backPage.addEventListener('click', () => {
            const currentPage = backPage.getAttribute('data-page');
            document.querySelector('.show-content').innerHTML = '';
            fetch(`/CMS/{{ $user->name }}/back-listform?page=${currentPage}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.show-content').innerHTML = html;
                    nextListForm1();
                    backListForm2();
                    noticeItemForm();
                })
                .catch(error => console.error('Error:', error));
        });
    };  
};

const backListForm2 = () =>{
  if(document.querySelector('.notice-previous')){
      const backPage = document.querySelector('.notice-previous');
      backPage.addEventListener('click', () => {
            const currentPage = backPage.getAttribute('data-page');
            document.querySelector('.show-content').innerHTML = '';
            fetch(`/CMS/{{ $user->name }}/back-listform?page=${currentPage}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.show-content').innerHTML = html;
                    nextListForm1();
                    backListForm1();
                    noticeItemForm();
                })
                .catch(error => console.error('Error:', error));
        });
    };  
};


const tabs = document.querySelectorAll('.tab');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const content = tab.getAttribute('data-content');
      switch (content) {
        case 'list':
          document.querySelector('.show-content').innerHTML = '';
          fetch('/CMS/{{ $user->name }}/list-content', {
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          })
          .then(response => response.text()) 
          .then(html => {
              document.querySelector('.show-content').innerHTML = html;
              nextListForm1();
              noticeItemForm();
          })
          .catch(error => console.error('Error:', error));
            break;
        case 'details':
          document.querySelector('.show-content').innerHTML = '';
          fetch('/CMS/{{ $user->name }}/detail-content', {
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          })
          .then(response => response.text()) 
          .then(html => {
              document.querySelector('.show-content').innerHTML = html;
              detailPreForm1();
          })
          .catch(error => console.error('Error:', error));
            break;
        case 'contact':
          document.querySelector('.show-content').innerHTML = '';
          fetch('/CMS/{{ $user->name }}/contact-form', {
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          })
          .then(response => response.text()) 
          .then(html => {
              document.querySelector('.show-content').innerHTML = html;
              contactForm1();
          })
          .catch(error => console.error('Error:', error));
            break;
        default:
            window.alert("undefind");
      }
    });
  });

  const detailPreForm1 = () =>{
  if(document.querySelector('.detail-previous')){
      const detailPage = document.querySelector('.detail-previous');
      detailPage.addEventListener('click', () => {
            const detTitle = detailPage.textContent.split(':')[1];
            console.log(detTitle)
            document.querySelector('.show-content').innerHTML = '';
            fetch('/CMS/{{ $user->name }}/detail-pageform', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                },
                body: JSON.stringify({ title: detTitle })
            })
            .then(response => response.text())
            .then(html => {
                document.querySelector('.show-content').innerHTML = html;
                detailPreForm2();
                detailMoreForm1();
            })
            .catch(error => console.error('Error:', error));
        });
  };  
  };

  const detailPreForm2 = () =>{
  if(document.querySelector('.detail-previous')){
      const detailPage = document.querySelector('.detail-previous');
      detailPage.addEventListener('click', () => {
            const detTitle = detailPage.textContent.split(': ')[1];
            document.querySelector('.show-content').innerHTML = '';
            fetch('/CMS/{{ $user->name }}/detail-pageform', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                },
                body: JSON.stringify({ title: detTitle })
            })
            .then(response => response.text())
            .then(html => {
                document.querySelector('.show-content').innerHTML = html;
                detailPreForm1();
                detailMoreForm1();
            })
            .catch(error => console.error('Error:', error));
        });
  };  
  };

  const detailMoreForm1 = () =>{
  if(document.querySelector('.detail-more')){
      const detailPage = document.querySelector('.detail-more');
      detailPage.addEventListener('click', () => {
            const detTitle = detailPage.textContent.split(':')[1];
            console.log(detTitle)
            document.querySelector('.show-content').innerHTML = '';
            fetch('/CMS/{{ $user->name }}/detail-pageform', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                },
                body: JSON.stringify({ title: detTitle })
            })
            .then(response => response.text())
            .then(html => {
                document.querySelector('.show-content').innerHTML = html;
                detailMoreForm2();
                detailPreForm1();
            })
            .catch(error => console.error('Error:', error));
        });
  };  
  };

  const detailMoreForm2 = () =>{
  if(document.querySelector('.detail-more')){
      const detailPage = document.querySelector('.detail-more');
      detailPage.addEventListener('click', () => {
            const detTitle = detailPage.textContent.split(':')[1];
            console.log(detTitle)
            document.querySelector('.show-content').innerHTML = '';
            fetch('/CMS/{{ $user->name }}/detail-pageform', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                },
                body: JSON.stringify({ title: detTitle })
            })
            .then(response => response.text())
            .then(html => {
                document.querySelector('.show-content').innerHTML = html;
                detailMoreForm1();
                detailPreForm1();
            })
            .catch(error => console.error('Error:', error));
        });
  };  
  };

  const noticeItemForm = () =>{
  if(document.querySelector('.notice-item')){
    document.querySelectorAll('.notice-item').forEach((item) => {
      item.addEventListener('click', () => {
        const noticeTitle = item.querySelector('.notice-title').textContent;
        console.log(noticeTitle);
        document.querySelector('.show-content').innerHTML = '';
        fetch(`/CMS/{{ $user->name }}/notice-itemform`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({ title: noticeTitle })
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('.show-content').innerHTML = html;
            detailMoreForm1();
            detailPreForm1();
        })
        .catch(error => console.error('Error:', error));
      });
    });
  };  
  };

    const contactForm1 = () =>{
      const contactForm = document.querySelector('.contact-form');
      contactForm.addEventListener('submit', (event) => {
       event.preventDefault();
       const formData = new FormData(contactForm); 
       document.querySelector('.show-content').innerHTML = '';
       fetch('/CMS/{{ $user->name }}/contact-form1', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData 
       })
       .then(response => response.text())
       .then(html => {
           document.querySelector('.show-content').innerHTML = html;
           cancelForm();
           contactForm2();
       })
       .catch(error => console.error('Error:', error));
      });
    };

    const contactForm2 = () =>{
      const contactForm = document.querySelector('.confirmation-form');
      contactForm.addEventListener('submit', function(e) {
       e.preventDefault(); 
       const formData = new FormData(contactForm);
       document.querySelector('.show-content').innerHTML = '';
       fetch('/CMS/{{ $user->name }}/contact-form2', {
           method: 'POST',
           headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               'Accept': 'application/json', 
           },
           body: formData
       })
       .then(response => response.json()) 
       .then(data => {
           if(data.success) {
            document.querySelector('.show-content').innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000; width: 80%; max-width: 300px; text-align: center;">送信が完了しました</div>';
            setTimeout(() =>{
              document.querySelector('.show-content').innerHTML = '';
               fetch('/CMS/{{ $user->name }}/contact-form', {
                   headers: {
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                   }
               })
               .then(response => response.text()) 
               .then(html => {
                   document.querySelector('.show-content').innerHTML = html;
                   contactForm1();
               })
               .catch(error => console.error('Error:', error));
            }, 4500); 
           } else {
            document.querySelector('.show-content').innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000; width: 80%; max-width: 300px; text-align: center;">送信に失敗しました</div>';
            setTimeout(() =>{
              document.querySelector('.show-content').innerHTML = '';
               fetch('/CMS/{{ $user->name }}/contact-form', {
                   headers: {
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                   }
               })
               .then(response => response.text()) 
               .then(html => {
                   document.querySelector('.show-content').innerHTML = html;
                   contactForm1();
               })
               .catch(error => console.error('Error:', error));
            }, 4500); 
           }
       })
       .catch(error => console.error('Error:', error));
      });
    };

    const cancelForm = () =>{
      const cancel = document.querySelector('.fa-xmark');
      cancel.addEventListener('click', () => { 
        document.querySelector('.show-content').innerHTML = '';
          fetch('/CMS/{{ $user->name }}/contact-form', {
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          })
          .then(response => response.text()) 
          .then(html => {
              document.querySelector('.show-content').innerHTML = html;
              contactForm1();
          })
          .catch(error => console.error('Error:', error));
      });
    }
</script>