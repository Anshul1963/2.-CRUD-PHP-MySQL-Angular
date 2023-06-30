// import { UserDetailsComponent } from '../user-details/user-details.component';
import { Observable } from "rxjs";
import { UserService } from "../user.service";
import { User } from "../user";
import { Component, OnInit } from "@angular/core";
import { Router } from '@angular/router';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: "app-user-list",
  templateUrl: "./user-list.component.html",
  styleUrls: ["./user-list.component.css"]
})
export class UserListComponent implements OnInit {
  users: Observable<User[]>;
  pageNo :number= 1;

  search = new FormGroup({
    searchBy: new FormControl(),
    searchInput: new FormControl(),
  })

  constructor(private userService: UserService,private http: HttpClient,
    private router: Router) {}

  ngOnInit() {
    this.reloadData();
  }
  onSubmit(){
    console.log(this.search.value);
    this.users = this.http.get<any>(`http://localhost:8080/read.php`,{ params: { searchInput:this.search.value.searchInput , searchBy:this.search.value.searchBy} });
    // this.userService.getUsersList2(this.search.value.searchInput, this.search.value.searchBy);
  }

  reloadData() {
    this.users = this.userService.getUsersList(this.pageNo);
    console.log(this.users);
  }
  reloadDataPrev() {
    if(this.pageNo != 1){
      this.pageNo = this.pageNo - 1;
      this.users = this.userService.getUsersList(this.pageNo); 
    }
    
  }
  reloadDataNext() {
    if(this.pageNo != 3){
      this.pageNo = this.pageNo + 1;
      this.users = this.userService.getUsersList(this.pageNo);
    }  
  }

  deleteUser(id: string) {
    const res = confirm("Are yot sure?");
    if(res === true){
      this.userService.deleteUser(id).subscribe( data => {
          this.reloadData();
      },
      error => console.log(error));
    }
    else{
      return;
    }
  }
  updateUser(id: string){
    this.router.navigate(['update', id]);
  }
}

