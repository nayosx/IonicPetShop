import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import * as environment from '../../shared/environment';

@Injectable()
export class ProductServiceProvider {

  constructor(public http: HttpClient) {}

  public getProducts() {
    return this.http.get<any>(environment.API_GET.concat('product'))
    .pipe(
        map(
            response => {
                return response;
            }
        )
    );
  }
}
