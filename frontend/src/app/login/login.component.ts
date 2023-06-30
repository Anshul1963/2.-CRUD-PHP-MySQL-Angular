import { UserService } from '../user.service';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Observable } from "rxjs";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginStatus:string;
  login = new FormGroup({
    userName: new FormControl('',[Validators.required]),
    password: new FormControl('',[Validators.required]),
  })
  get userName(){
    return this.login.get('userName');
  }
  get password(){
    return this.login.get('password');
  }

  constructor(private userService: UserService, private router: Router) { }

  ngOnInit(){}

  onSubmit()
  {
    this.userService.loginUser(this.login.value.userName, this.login.value.password).subscribe(data =>{
      console.log(data);
      this.loginStatus = data.result;
      if(data.result == "loggedIn"){
        console.log("loggedIn");
        sessionStorage.setItem('login', 'true');
         this.router.navigate(['/users']);
      }
    },error=>console.log(error));
  }

}
