import { Component } from '@angular/core';
import { UserService } from './user.service';
import {Router} from '@angular/router'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'PHP + Angular 10 + MySQL CRUD ';

  constructor(private userService: UserService, private router: Router) { }

  logout(){
    this.userService.logout().subscribe(data =>{
      console.log(data);
      sessionStorage.clear();
    },error=>console.log(error));
  }

  login:string = sessionStorage.getItem("loginUserId");

}
