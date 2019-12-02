import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import * as environment from '../../shared/environment';

@Injectable()
export class ProductServiceProvider {

  constructor(public http: HttpClient) {}

  public getProducts() {
    return this.http.get<any>(environment.API_ENDPOINT.concat('product'))
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }

  /*public getProducts(){
    return [
      {
        'id': 1,
        'name': 'Gato Persa',
        'img': 'kitten.jpg',
        'price': 200,
        'description': "Llamado simplemente gato, minino, ​ michino, ​ michi, ​ micho, ​ mizo, ​ miz, ​ morroño​ o morrongo, ​ entre otros nombres coloquiales, es un mamífero carnívoro de la familia Felidae. Es una subespecie domesticada por la convivencia con el ser humano"
      },
      {
        'id': 2,
        'name': 'Iguana Gala',
        'img': 'iguana.jpg',
        'price': 100,
        'description': "Las iguanas son animales herbívoros y ovíparos. Ponen sus huevos bajo tierra durante el mes de febrero. Alcanzan la madurez sexual a los 16 meses de edad, pero son consideradas adultas a los 36 meses, cuando miden 70 cm de largo."
      },
      {
        'id': 3,
        'name': 'Conejo Indio',
        'img': 'rabbit.jpg',
        'price': 60,
        'description': "Se caracteriza por tener un cuerpo cubierto de un pelaje espeso y lanudo, de color pardo pálido a gris, cabeza ovalada y ojos grandes. Pesa entre 1,5 y 2,5 kg en estado salvaje. Tiene orejas largas de hasta 7 cm las cuales le ayudan a regular la temperatura del cuerpo y una cola muy corta. Sus patas anteriores son más cortas que las posteriores"
      },
      {
        'id': 4,
        'name': 'Pato Pequines',
        'img': 'duck.jpg',
        'price': 20,
        'description': "Su peso es de entre 3,6 y 4,1 kg, aunque se han desarrollado variedades mayores. Su plumaje es blanco y tiene el pico las piernas y las patas de color naranja. Algunos pueden tener el pico más amarillo, pero si tienen el pico negro se considera una seria falta en la clasificación. El Pato Pekín blanco es un pato de rápido crecimiento; y los pollos son fáciles de distinguir de los adultos porque tienen un plumaje brillante y amarillo."
      },
      {
        'id': 5,
        'name': 'Perro Galgo',
        'img': 'puppy.jpg',
        'price': 500,
        'description': "Hay aproximadamente cuatrocientas razas —más que de cualquier otro animal— que varían significativamente en tamaño, fisonomía y temperamento, presentando una gran variedad de colores y de tipos de pelo según la raza"
      },
      {
        'id': 6,
        'name': 'Ratón Mongol',
        'img': 'mouse.jpg',
        'price': 10,
        'description': "El más común y conocido es el ratón de casa (Mus musculus), el segundo mamífero más extendido del planeta tras el ser humano. Aunque varias especies de ratones habitan en el ámbito doméstico, tanto como comensales de los humanos, como mascotas y animales de laboratorio, otras son de hábitat rural"
      },
      {
        'id': 7,
        'name': 'Tortuga Filipina',
        'img': 'turtle.jpg',
        'price': 1500,
        'description': "La característica más importante del esqueleto de las tortugas es que una gran parte de su columna vertebral está soldada a la parte dorsal del caparazón. El esqueleto hace que la respiración sea imposible por movimiento de la caja torácica; se realiza principalmente por la contracción de los músculos abdominales modificados que funcionan de modo análogo al diafragma de los mamíferos y por movimientos de bombeo de la faringe"
      }
    ];
  }*/

}
