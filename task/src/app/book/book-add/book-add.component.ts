import { Component, OnInit } from '@angular/core';


import { BookService } from './../../book.service';
import { Book } from './../../book';
import {ActivatedRoute, Params, Router } from '@angular/router';

@Component({
  selector: 'app-book-add',
  templateUrl: './book-add.component.html',
  styleUrls: ['./book-add.component.css']
})
export class BookAddComponent implements OnInit {

  constructor(
    private bookService: BookService,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
  }

model = new Book();
  addBook(){
      this.bookService
        .addBook(this.model)
        .subscribe(()=> this.goBack());
  }
   goBack(){
    this.router.navigate(['/book']);
  }
}
