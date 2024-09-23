import {
  Button,
  Card,
  CardActions,
  CardContent,
  Rating,
  Typography,
} from "@mui/material";
import Book from "../interfaces/book";
import { Star } from "@mui/icons-material";
import { Link } from "react-router-dom";

interface BookCardI extends Book {
  onClick: (bookId: string) => void;
}

export default function BookCard({
  id,
  name,
  authors,
  price,
  onClick,
}: BookCardI) {
  return (
    <Card sx={{ w: 60, h: 100 }}>
      <CardContent>
        <img
          className="rounded-md"
          src="https://m.media-amazon.com/images/I/51vUhSqDEmL._SX342_SY445_.jpg"
        />
        <Link to={`/book/${id}`}>
          <Typography fontSize={16}>{name}</Typography>
        </Link>
        <Link to={`/author/${authors[0].id}`}>
          <Typography fontSize={12}>
            {">"} {authors[0].name}
          </Typography>
        </Link>
        <Rating
          size="small"
          value={2.5}
          precision={0.5}
          emptyIcon={<Star style={{ opacity: 0.55 }} fontSize="inherit" />}
          readOnly
        />
        <Typography fontSize={18}>R$ {price}</Typography>
      </CardContent>
      <CardActions>
        <Button size="small" onClick={() => onClick(id)}>
          Add to Shelf
        </Button>
      </CardActions>
    </Card>
  );
}
