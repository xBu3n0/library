import { ShoppingCart } from "@mui/icons-material";
import { Badge, IconButton } from "@mui/material";
import { useContext } from "react";
import { Link } from "react-router-dom";
import AuthContext from "../contexts/AuthContext";

export default function Cart({
  cartCounter,
}: Readonly<{ cartCounter: number }>) {
  const auth = useContext(AuthContext);

  return (
    <>
      {auth && (
        <Link to={"/cart"}>
          <IconButton>
            <Badge badgeContent={cartCounter}>
              <ShoppingCart />
            </Badge>
          </IconButton>
        </Link>
      )}
    </>
  );
}
