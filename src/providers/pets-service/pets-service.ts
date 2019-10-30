//import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the PetsServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class PetsServiceProvider {

  constructor(
    //public http: HttpClient
    ) {
    console.log('Hello PetsServiceProvider Provider');
  }

  public pets(){
    return [
      {
        'id': 1,
        'name': 'Gato Persa',
        'img': 'kitten.jpg',
        'price': 200,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 2,
        'name': 'Iguana Gala',
        'img': 'iguana.jpg',
        'price': 100,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 3,
        'name': 'Conejo Indio',
        'img': 'rabbit.jpg',
        'price': 60,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 4,
        'name': 'Pato Pequines',
        'img': 'duck.jpg',
        'price': 20,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 5,
        'name': 'Perro Galgo',
        'img': 'puppy.jpg',
        'price': 500,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 6,
        'name': 'Ratón Mongol',
        'img': 'mouse.jpg',
        'price': 10,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      },
      {
        'id': 7,
        'name': 'Tortuga Filipina',
        'img': 'turtle.jpg',
        'price': 1500,
        'description': "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
      }
    ];
  }

}
