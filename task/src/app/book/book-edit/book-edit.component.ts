import { Component, OnInit } from '@angular/core';

import { BookService } from './../../book.service';
import { Book } from './../../book';
import {ActivatedRoute, Params, Router } from '@angular/router';

@Component({
  selector: 'app-book-edit',
  templateUrl: './book-edit.component.html',
  styleUrls: ['./book-edit.component.css']
})
export class BookEditComponent implements OnInit {

  constructor(private bookService: BookService,
              private router: Router,
              private route: ActivatedRoute
            ) { }

  ngOnInit() {
    this.getBook();
  }
  model = new Book();
  
  getBook(){
    var id = this.route.snapshot.params['id'];
    this.bookService.getBook(id)
    .subscribe(books=>{
      this.model = books[0];
    })    
  }

  editBook(){
    var id = this.route.snapshot.params['id'];
      this.bookService.editBook(this.model)
        .subscribe(()=> this.goBack());
        
  }
   goBack(){
    this.router.navigate(['/book-edit']);
  }

}
