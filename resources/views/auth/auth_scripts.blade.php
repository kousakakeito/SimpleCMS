<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    
    const formContainer = document.querySelector('#form-container');
    window.addEventListener('load', () => {
        fetch('/auth-form')
            .then(response => response.text())
            .then(html => {
                formContainer.innerHTML = html;
                loginForm();
                registerForm();
            })
            .catch(error => console.error('Error:', error));
    });

    const loginForm = () =>{
      const loginText = document.querySelector('#login-link');
      loginText.addEventListener('click', () => { 
        formContainer.innerHTML = '';
        fetch('/login-form')
          .then(response => response.text())
          .then(html => {
              formContainer.innerHTML = html;
              cancelForm();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const registerForm = () =>{
      const registerText = document.querySelector('#register-link');
      registerText.addEventListener('click', () => { 
        formContainer.innerHTML = '';
        fetch('/register-form')
          .then(response => response.text())
          .then(html => {
              formContainer.innerHTML = html;
              cancelForm();
          })
          .catch(error => console.error('Error:', error));
      });
    };

    const cancelForm = () =>{
      const cancel = document.querySelector('.fa-xmark');
      cancel.addEventListener('click', () => { 
        formContainer.innerHTML = '';
        fetch('/auth-form')
          .then(response => response.text())
          .then(html => {
              formContainer.innerHTML = html;
              loginForm();
              registerForm();
          })
          .catch(error => console.error('Error:', error));
      });
    }

  });
</script>


