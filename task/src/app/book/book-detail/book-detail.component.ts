import { Book } from './../../book';
import { Component, OnInit } from '@angular/core';
import { BookService } from '../../book.service';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-book-detail',
  templateUrl: './book-detail.component.html',
  styleUrls: ['./book-detail.component.css']
})
export class BookDetailComponent implements OnInit {

  constructor(
    private bookService: BookService,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.getBook();
  }

  book:Book;
  getBook(){
    var id = this.route.snapshot.params['id'];
    this.bookService.getBook(id)
    .subscribe(book=>{
      this.book = book;
    })
  }

  goBack(){
    this.router.navigate(['/book'])
  }
}
