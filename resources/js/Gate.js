export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.role ==='admin';
    }

    isAdminOrAccounts(){

        if(this.user.role ==='admin' || this.user.role ==='accounts'){
                return true;
        }
    }

    isAdminOrDriver(){

        if(this.user.role ==='admin' || this.user.role ==='driver'){
                return true;
        }
    }

    isClientOrAdmin(){

        if(this.user.role ==='client' || this.user.role ==='admin'){
                return true;
        }
    }

    isDriver(){
        return this.user.role ==='driver';
    }

    isClient(){
        return this.user.role ==='client';
    }
    
    isAccounts(){
        return this.user.role ==='accounts';
    }



}