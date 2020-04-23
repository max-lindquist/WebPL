import { Injectable } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Order } from './order';


@Injectable({
  providedIn: 'root'
})
export class OrderService {

  order = new Order('', '', null, '', '', null);

  constructor(private http: HttpClient) { }

  sendRequest(data: any): Observable<any> {
    // return this.http.post('http://localhost/php/ngphp-post.php', data, {responseType: 'text'});
    // return this.http.post('http://localhost/php/ngphp-post.php', data, {responseType: 'json'});
    return this.http.post('http://localhost/php/ngphp-post.php', data);
  }

  sendOrder(data): Observable<Order> {
     return this.sendRequest(data);
  }
}
