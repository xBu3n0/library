import { AutoStories } from "@mui/icons-material";
import { Box, Typography } from "@mui/material";
import { amber } from "@mui/material/colors";
import { Link } from "react-router-dom";
import Notification from "./Notification";
import UserMenu from "./UserMenu";
import Cart from "./Cart";
import HeaderMenu from "./HeaderMenu";

export default function Header({
  cartCounter,
}: Readonly<{ cartCounter: number }>) {
  return (
    <Box
      sx={{
        bgcolor: amber[200],
        p: 2,
        w: "full",
        display: "flex",
        justifyContent: "space-between",
        alignItems: "center",
      }}
      component="nav"
    >
      <Box>
        <Link to={"/"}>
          <Box
            sx={{
              alignItems: "center",
              alignContent: "center",
              display: "flex",
              gap: 2,
            }}
          >
            <AutoStories />{" "}
            <Typography component="h4" variant="h5">
              Home page
            </Typography>
          </Box>
        </Link>
      </Box>

      <HeaderMenu />

      <Box sx={{ alignItems: "center", display: "flex", gap: 2 }}>
        <Notification />
        <Cart cartCounter={cartCounter} />
        <UserMenu />
      </Box>
    </Box>
  );
}
