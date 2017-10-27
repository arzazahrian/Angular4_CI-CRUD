import { ActivatedRoute, Params, Router } from '@angular/router';
import { BookService } from './../book.service';
import { Book } from "../book";


import { Component, OnInit } from '@angular/core';


@Component({
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.css']
})
export class BookComponent implements OnInit {

  constructor(public bookService: BookService,
               ) { }
  books:any;
  
  ngOnInit() {
    this.getBooks();
  }

  getBooks(){
    this.bookService.getBooks()
    .subscribe(books=>{
      this.books = books.data;
    })    
  }

  deleteBook(id){
    this.bookService.deleteBook(id)
    .subscribe(() =>{
      this.getBooks();
    })

    
  }

}
