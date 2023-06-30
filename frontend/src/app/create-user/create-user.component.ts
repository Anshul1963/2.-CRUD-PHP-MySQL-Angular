import { UserService } from '../user.service';
import { User } from '../user';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {FormGroup, FormControl, Validators} from '@angular/forms';

@Component({
  selector: 'app-create-user',
  templateUrl: './create-user.component.html',
  styleUrls: ['./create-user.component.css']
})
export class CreateUserComponent implements OnInit {

  user: User = new User();
  submitted = false;
  addForm = new FormGroup({
    name: new FormControl('',[Validators.required,Validators.pattern('[a-zA-Z]+$')]),
    email: new FormControl('',[Validators.required,Validators.email]),
    mobile: new FormControl('',[Validators.required,Validators.minLength(10),Validators.maxLength(10)]),
    address: new FormControl('',[Validators.required]),
    state: new FormControl('',[Validators.required]),
    gender: new FormControl('',[Validators.required]),
    message: new FormControl('',[Validators.required]),
    newsletter: new FormControl(),
  })

  get name(){
    return this.addForm.get('name');
  }
  get email(){
    return this.addForm.get('email');
  }
  get mobile(){
    return this.addForm.get('mobile');
  }
  get address(){
    return this.addForm.get('address');
  }
  get state(){
    return this.addForm.get('state');
  }
  get gender(){
    return this.addForm.get('gender');
  }
  get message(){
    return this.addForm.get('message');
  }


  constructor(private userService: UserService,private router: Router) { }

  ngOnInit() {
  }

  newUser(): void {
    this.submitted = false;
    this.user = new User();
  }

  save() {
    this.userService.createUser(this.addForm.value).subscribe(data => {
      console.log(data)
      this.user = new User();
        this.gotoList();
    }, 
    error => console.log(error));
  }

  onSubmit() {
    console.log(this.addForm.value);
    this.submitted = true;
    this.save();    
  }

  gotoList() {
    this.router.navigate(['/users']);
  }
}