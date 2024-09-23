import { useCallback, useState } from "react";
import { Box, Button, Container, Typography } from "@mui/material";
import { blue } from "@mui/material/colors";
import Book from "./interfaces/book";
import BookCard from "./components/BookCard";
import { useOutletContext } from "react-router-dom";
import api from "./axios/api";

interface OutletI {
  setCartCounter: (cartCounter: number) => void;
}

function App() {
  const context = useOutletContext<OutletI>();

  const setCartCounter = context.setCartCounter;

  const addBook = useCallback(
    async (id: string) => {
      const result = await api.get(`/addBook/${id}`);

      console.log(result.data);

      setCartCounter(result.data.cartCounter);
    },
    [setCartCounter],
  );

  const books: Book[] = [
    {
      id: "120",
      name: "A1",
      authors: [
        { id: "124", name: "VC" },
        { id: "126", name: "VxC" },
      ],
      price: 23.49,
    },
    {
      id: "121",
      name: "A1",
      authors: [{ id: "124", name: "VC" }],
      price: 23.49,
    },
    {
      id: "122",
      name: "A1",
      authors: [{ id: "124", name: "VC" }],
      price: 23.49,
    },
    {
      id: "123",
      name: "A1",
      authors: [{ id: "124", name: "VC" }],
      price: 23.49,
    },
    {
      id: "124",
      name: "A1",
      authors: [{ id: "124", name: "VC" }],
      price: 23.49,
    },
    {
      id: "125",
      name: "A1",
      authors: [{ id: "124", name: "VC" }],
      price: 23.49,
    },
  ];

  return (
    <Container maxWidth="xl">
      <title>Home page</title>

      <Box sx={{ bgcolor: blue[100] }}>
        <Typography component="h2" fontSize={24}>
          Maybe you like
        </Typography>
        <Box
          sx={{
            display: "flex",
            flexDirection: "row",
            gap: 2,
            justifyContent: "center",
            p: 4,
          }}
        >
          {books.map((book) => (
            <BookCard {...book} onClick={addBook} />
          ))}
        </Box>
      </Box>
    </Container>
  );
}

export default App;
