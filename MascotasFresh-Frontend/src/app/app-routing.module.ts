import { AdminComponent } from './admin/admin.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router'; // CLI imports router
import { AppComponent } from './app.component';
import { AnimalComponent } from './animal/animal.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegistroComponent } from './registro/registro.component';
import { CitaComponent } from './cita/cita.component';
import { ProductComponent } from './product/product.component'

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'animal', component: AnimalComponent },
  { path: 'login', component: LoginComponent },
  { path: 'registro', component: RegistroComponent },
  { path: 'cita', component:CitaComponent },
  { path: 'admin',component:AdminComponent },
  { path: 'producto', component:ProductComponent }

]; // sets up routes constant where you define your routes

// configures NgModule imports and exports
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }