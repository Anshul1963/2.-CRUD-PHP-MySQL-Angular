import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  public baseUrl = 'http://localhost:8080';

  constructor(private http: HttpClient) { }

  getUser(id: string): Observable<any> {
    return this.http.get(`${this.baseUrl}/single_user.php`,{ params: { id: id } });
  }

  createUser(user: Object): Observable<Object> {
    return this.http.post(`${this.baseUrl}/create.php`, user);
  }

  updateUser(user: Object): Observable<Object> {
    return this.http.put(`${this.baseUrl}/update.php`, user);
  }

  deleteUser(id: string): Observable<any> {
    return this.http.delete(`${this.baseUrl}/delete.php`,{ params: { id: id } });
  }

  getUsersList(pageNo:any): Observable<any> {
    return this.http.get(`${this.baseUrl}/read.php`,{ params: { pageNo: pageNo } });
  }

  getUsersList2(search:string , searchBy:string): Observable<any> {
    return this.http.get(`${this.baseUrl}/read.php`,{ params: { search: search , searchBy:searchBy} });
  }

  loginUser(userName:string, password:string): Observable<any> {
    return this.http.get(`${this.baseUrl}/login.php`,{ params: { userName:userName , password: password} });
  }

  logout(){
    return this.http.get(`${this.baseUrl}/logout.php`);
  }

  registerUser(email:string, userName:string, password:string): Observable<any> {
    return this.http.get(`${this.baseUrl}/registration.php`,{params: {email: email, userName: userName, password: password}});
  }

}