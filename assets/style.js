function toggleMenu() {
    let navigation = document.querySelector('.navigation');
    // let navigation_user = document.querySelector('.navigation-user');
    let toggle = document.querySelector('.toggle');

    // navigation_user.classList.toggle('active');
    navigation.classList.toggle('active');

    toggle.classList.toggle('active');

    //prevent default submission
    preventDefault();
}

function toggleMenuUser() {
    let navigation_user = document.querySelector('.navigation-user');
    let toggle_user = document.querySelector('.toggle');
    
    //prevent default submission
    // preventDefault();
    
    navigation_user.classList.toggle('active');
    toggle_user.classList.toggle('active');

}