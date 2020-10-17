// registerForm
var registerForm = {
    // el : element of DOM : form
    el: null,
    init: function() {
        // store in "el " element html form 
        registerForm.el = document.getElementsByClassName('form-register')[0];
        // registe the event "submit" of the form
        registerForm.el.addEventListener('submit', registerForm.onSubmit);
    },
    onSubmit: function(evt) {
        // prevent the submission 
        evt.preventDefault();
        // to get the data of form
        const formData = new FormData(registerForm.el);
       
        // Build the payload that will send to api
        const payload = {
            firstname: formData.get('firstname'),
            lastname: formData.get('lastname'),
            login: formData.get('login') ,
            password: formData.get('password'),
            date_of_birth: 
                formData.get('day') + '/' + formData.get('month') + '/' + formData.get('year'),
            gender: formData.get('gender'),
        };

        // debug
        console.log(payload);

        // Send the login request to api
        axios.post(
            '/api/public/index.php/api/register',
            payload
        )
            .then(function(res) {
                console.log(res.data);
                alert('Vous êtes bien inscrit désormait');
                //alert('Bienvenue ' + res.data.login);
            })
            .catch(function(error) {
                console.log(error.res.data);
                alert('Il y a une erreur dans le formulaire');
            });
    }
}
// wait te page is loaded to init LoginForm
document.addEventListener('DOMContentLoaded', registerForm.init);