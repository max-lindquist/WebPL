import { Component } from '@angular/core';
import { Suggestion } from './suggestion';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'fLash mE';
  authors = 'JR, SC, ML';

  constructor(private http: HttpClient) {   }

  // Let's create a property to store a response from the back end
  // and try binding it back to the view
  responsedata = new Suggestion('', '', '', '', null);
  suggestionModel = new Suggestion('someone', 'someone@uva.edu', '', '', true);


  confirm_msg = '';
  data_submitted = '';

  confirmSuggestion(data) {
     console.log(data);
     this.confirm_msg = 'Thank you, ' + data.name + '(' + data.name.length + ')';
     this.confirm_msg += '. You suggested ' + data.suggestion;
  }


  // Assume we want to send a request to the backend when the form is submitted
  // so we add code to send a request in this function

  onSubmit(form: any): void {
     console.log('You submitted value: ', form);
     this.data_submitted = form;

     // Convert the form data to json format
     let params = JSON.stringify(form);

     // To send a GET request, use the concept of URL rewriting to pass data to the backend
     // this.http.get<Order>('http://localhost/cs4640/inclass11/ngphp-get.php?str='+params)
     // To send a POST request, pass data as an object
     this.http.post<Suggestion>('http://localhost/php/ngphp-post.php', params)
     .subscribe((data) => {
          // Receive a response successfully, do something here
          // console.log('Response from backend ', data);
          this.responsedata = data;     // assign response to responsedata property to bind to screen later
     }, (error) => {
          // An error occurs, handle an error in some way
          console.log('Error ', error);
     })
  }
}
