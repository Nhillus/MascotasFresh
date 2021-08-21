import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  title = 'MascotasFresh-Frontend';

  logeado = false;

  ngOnInit() {
    this.logeado = localStorage.getItem('token') !== null; //significa que estamos logeado hasta que el token sea retirado del localstorage
  }

  logout() {
    localStorage.removeItem('token');
  }
}
