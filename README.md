# BOOK REVIEWS 


## LEARN

### Shell 

Activate shell (tinker)
```
> php artisan tinker
```

Then use to check data/debug.
```
# Check the data from ID 1.
> \App\Models\Book::find(1);
> \App\Models\Book::findOrFail(1);

# Check the data with REVIEWS related using "with()" method. 
> \App\Models\Book::with('reviews')->findOrFail(1);

# Get 3 rows
books = \App\Models\Book::with('reviews')->take(3)->get();
```

Load
```
> $book = \App\Models\Book:find(1);
> $book->load('reviews,'); # Relational One To Many.
> $book->load('reviews,', 'another_relationship', 'another_two'); # More Relationship table

> $review = new \App\Models\Review();
> $review->review = 'This is a cool';
> $review->rating = 3 ;
#> $review->book_id = 1;
#> $review->save();

# SAME AS
> $book->reviews()->save($review);

```

### LOCAL QUERY SCOPES

Find with `where` clause (on tinker)
```
> \App\Models\Book::where('title', 'LIKE', '%qui%')->get();

# WITH LOCAL QUERY SCOPES
> \App\Models\Book::title('somewhere')->get();
> \App\Models\Book::title('somewhere')->where('created_at', '>', '[some date]')->get();
```

## TO SQL

Get a setence from SQL.
```
> \App\Models\Book::title('delectus')->where('created_at','>', '2023-10-10')->toSql();
```

## AGGREGATIONS ON RELATIONS

```
> \App\Models\Book::withCount('reviews')->get();
> \App\Models\Book::withCount('reviews')->latest()->get();
> \App\Models\Book::withCount('reviews')->latest()->limit(3)->get();
```

Lowest Rating
```
> \App\Models\Book::limit(5)->withAvg('reviews','rating')->orderBy('reviews_avg_rating)->get();
> \App\Models\Book::limit(5)->withAvg('reviews','rating')->orderBy('reviews_avg_rating)->toSql();

# Ten best rated books.  
> \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->orderBy('reviews_avg_rating', 'desc')->limit(10)->get();
> \App\Models\Book::withCount('reviews')->withAvg('reviews', 'rating')->having('reviews_count', '>=', 10)->toSql();
```

### With Models
```
> \App\Models\Book::popular()->highestRated()->get();
```
