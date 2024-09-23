import Author from "./author";

export default interface Book {
  id: string;
  name: string;
  authors: Author[];
  price: number;
}
