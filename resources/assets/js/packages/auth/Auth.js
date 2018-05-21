export default function (Vue) {
  Vue.auth={
    //sets the the the cookies that will wbe used in the application
    setToken(token,expiration,user_id){
      localStorage.setItem('token',token);
      localStorage.setItem('expiration',expiration);
      localStorage.setItem('user_id',user_id);
    },
    //get tokens for use 
    getToken(){
      var token = localStorage.getItem('token');
      var expiration = localStorage.getItem('expiration');
      var user_id = localStorage.getItem('user_id');

      var user_credentionals ={
        'token' : token,
        'expiration' : expiration,
        'user_id' : user_id,
      }
      if (!token || !expiration||!user_id) {
        return null;
      } else {
        //checks if the token has expired
        if (Date.now() > parseInt(expiration)) {
          this.destroyToken();
        }else {
          return token;
        }
      }
    },
    //destroy will be used to log out the user
    destroyToken(){
      localStorage.removeItem('token');
      localStorage.removeItem('expiration');
      localStorage.removeItem('user_id');

      return true;
    },
    getUserId(){
      //gets the user id for use in the application and returns it to the javascript
      var user_id = localStorage.getItem('user_id');
      return user_id;
    },
    //isAuthenticate
    //checks if the user has been auticatioed based on if the token was set in the cookies
    isAuthenticated() {
      if (this.getToken()) {
        return true;
      }else {
        return false;
      }
    },
    logout(){
      //func() that calls the destroy token to logout the user
      if (this.destroyToken()) {
        return true;
      }else{
        return false;
      }
    }
  }
  //defines the properties of the vue properties
  //allows for the use of the $auth propert
  //allows for it to be passed around the allcation as a package
  Object.defineProperties(Vue.prototype,{
    $auth:{
      get:()=>{
        return Vue.auth;
      }
    }
  })
};
