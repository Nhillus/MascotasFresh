import { NgModule, ViewChild } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { AnimalComponent } from './animal/animal.component';
import { AppRoutingModule } from './app-routing.module';
import { HomeComponent } from './home/home.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { DatepickerAdapterComponent } from './datepicker-adapter/datepicker-adapter.component';
import { LoginComponent } from './login/login.component';
import { NavbarComponent } from './navbar/navbar.component';
import { RegistroComponent } from './registro/registro.component';
import { CitaComponent } from './cita/cita.component';
import { AdminComponent } from './admin/admin.component';
import { ProductComponent } from './product/product.component';
import { SidebarComponent } from './sidebar/sidebar.component';



@NgModule({
  declarations: [
    AppComponent,
    AnimalComponent,
    HomeComponent,
    DatepickerAdapterComponent,
    LoginComponent,
    NavbarComponent,
    RegistroComponent,
    CitaComponent,
    AdminComponent,
    ProductComponent,
    SidebarComponent,


  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    NgbModule,



  ],
  exports: [AnimalComponent,DatepickerAdapterComponent],
  providers: [ ],
  bootstrap: [AppComponent]
})
export class AppModule { }
