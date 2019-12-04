import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import * as environment from '../../shared/environment';

@Injectable()
export class AutorServiceProvider {

  constructor(public http: HttpClient) {}

  public getAutor() {
    return this.http.get<any>(environment.API_GET.concat('autor'))
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }
}
