import { Params } from '@angular/router';
import { Injectable } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map' ;

@Injectable()
export class BookService {

  constructor(private http: Http) {
   
  }

    books=[];
    getBooks(){
      return this.http.get("http://localhost/restserver/book/list_book")
      .map(res => res.json());
    } 
    
    getBook(id){
      let bookParams = new URLSearchParams();
      bookParams.append('id',id);
      let option = new RequestOptions({params:bookParams});
      
      return this.http.get("http://localhost/restserver/book/get_book", option)
        .map(res=>res.json());
    }

    addBook(info){
      
      return this.http.post('http://localhost/restserver/book/add_book',info)
      .map(()=>"")
    }

    editBook(info){
      return this.http.post("http://localhost/restserver/book/update_book",info)
      .map(() => "");
    }

    deleteBook(id){
      
      let bookParams = new URLSearchParams();
      bookParams.append('id',id);
      let option = new RequestOptions({params:bookParams});
      
      return this.http.delete("http://localhost/restserver/book/destroy",option)
      .map(() => this.getBooks());

    }
    

}
