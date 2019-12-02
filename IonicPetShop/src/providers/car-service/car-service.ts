import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import * as environment from '../../shared/environment';

@Injectable()
export class CarServiceProvider {

  constructor(public http: HttpClient) {
    console.log('Hello CarServiceProvider Provider');
  }

  public getOrdenes(idUser) {
    return this.http.get<any>(environment.API_ENDPOINT.concat('car?idUser=', idUser))
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }

  public post(data) {
    return this.http.post<any>(environment.API_ENDPOINT.concat('car'), data)
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }

}
