// LoginForm
var loginForm = {
    // el : element of DOM : form
    el: null,
    init: function() {
        // store in "el " element html form 
        loginForm.el = document.getElementsByClassName('form-login')[0];
        // registe the event "submit" of the form
        loginForm.el.addEventListener('submit', loginForm.onSubmit);
    },
    onSubmit: function(evt) {
        // prevent the submission 
        evt.preventDefault();
        // to get the data of form
        const formData = new FormData(loginForm.el);
        // Debug
        console.log('on submit');

        // Build the payload that will send to api
        const payload = {
            login: formData.get('login'),
            password: formData.get('password')
        };

        // debug
        console.log(payload);

        // Send the login request to api
        axios.post(
            '/api/public/index.php/api/login',
            payload
        )
            .then(function(res) {
                alert('Bienvenue ' + res.data.login);
            })
            .catch(function(error) {
                alert(error.response.data.message);
            });
    }
}
// wait te page is loaded to init LoginForm
document.addEventListener('DOMContentLoaded', loginForm.init);