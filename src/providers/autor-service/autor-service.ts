//import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the AutorServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class AutorServiceProvider {

  constructor(
    //public http: HttpClient
    ) {
    console.log('Hello AutorServiceProvider Provider');
  }

  public getAutor() {
    return {
      'name': 'José Hernández',
      'carnet': 'HG101513',
      'email': 'jose004@ufg.edu.sv',
      'image': 'avatar.jpg'
    };
  }
}
