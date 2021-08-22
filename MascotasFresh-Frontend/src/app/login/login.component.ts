import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder } from "@angular/forms";
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  form: FormGroup;

  constructor(private fb:FormBuilder, 
              private http:HttpClient, 
              private router: Router) { 
    
    this.form = this.fb.group({
      email: '',
      password:'',
    })

  }

  ngOnInit(): void {
  }

  submit() {
    console.log(this.form.getRawValue());
    let formData = this.form.getRawValue();
    let data = {
      username: formData.email,
      password: formData.password,
      grant_type:'password',
      client_id: '2',
      client_secret:'1OKmZZiA951nifhhLSpb1A0PsSsFtt9Gx1hzRhDK',
      scope:'*'
    };
    let headers = new HttpHeaders({
      'Access-Control-Allow-Origin': 'http://localhost:8000',
      'Access-Control-Allow-Credentials':'true',
    });
    let options = { headers: headers };    
    this.http.post('http://localhost:8000/oauth/token',data,options).subscribe(
      (response:any) => {
        console.log('succes');
        console.log(response);
        localStorage.setItem('token',response.access_token);
        this.router.navigate(['/animal'])
      },
      error => {
        console.log('error');
        console.log(error)
      }
    )
  }

}
