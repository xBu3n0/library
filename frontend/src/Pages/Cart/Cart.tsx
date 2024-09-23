import { Button, Container, Paper } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import api from "../../axios/api";
import Book from "../../interfaces/book";

interface BookCounter extends Book {
  counter: number;
}

export default function Cart() {
  const [books, setBooks] = useState<BookCounter[]>([]);

  const fetch = useCallback(async () => {
    const response = await api.get("/cart/books");
    console.log(response.data.books);

    setBooks(response.data.books);
  }, []);

  useEffect(() => {
    fetch();
  }, [fetch]);

  return (
    <Container>
      {books.map((book, index) => (
        <Paper key={index}>
          {book.id} - {book.name} - {book.price} :: {book.counter}
        </Paper>
      ))}
    </Container>
  );
}
