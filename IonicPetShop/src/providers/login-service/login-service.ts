import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import * as environment from '../../shared/environment';

@Injectable()
export class LoginServiceProvider {

  constructor(public http: HttpClient) {
    console.log('Hello LoginServiceProvider Provider');
  }

  public post(data) {
    return this.http.post<any>(environment.API_ENDPOINT.concat('login'), data)
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }

}
