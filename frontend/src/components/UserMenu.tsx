import {
  Book,
  Login,
  Logout,
  Person,
  Settings,
  ShoppingCart,
} from "@mui/icons-material";
import {
  Avatar,
  Box,
  ClickAwayListener,
  Fade,
  Grow,
  IconButton,
  List,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  Paper,
  Popper,
  Tooltip,
  Typography,
} from "@mui/material";
import { useContext, useRef, useState } from "react";
import { Link } from "react-router-dom";
import AuthContext from "../contexts/AuthContext";

export default function UserMenu() {
  const auth = useContext(AuthContext);

  const [menuOpen, setMenuOpen] = useState(false);
  const menuRef = useRef(undefined);

  const menuOptions = [{ path: "/login", icon: <Login />, text: "Log In" }];

  const menuLoggedOptions = [
    { path: "/profile", icon: <Person />, text: "Profile" },
    { path: "/settings", icon: <Settings />, text: "Settings" },
    { path: "/logout", icon: <Logout />, text: "Log Out" },
  ];

  const options = auth ? menuLoggedOptions : menuOptions;

  if (auth?.is_admin) {
    options.push({ path: "/authors", icon: <Person />, text: "Authors" });
    options.push({ path: "/books", icon: <Book />, text: "Books" });
  }

  return (
    <ClickAwayListener onClickAway={() => setMenuOpen(false)}>
      <Box ref={menuRef}>
        <Tooltip
          arrow
          disableInteractive
          title={<Typography fontSize="small">Toggle User Menu</Typography>}
        >
          <IconButton onClick={() => setMenuOpen(true)}>
            <Avatar />
          </IconButton>
        </Tooltip>
        <Popper
          sx={{ zIndex: 1 }}
          anchorEl={menuRef.current}
          placement="bottom-end"
          open={menuOpen}
          transition
        >
          {({ TransitionProps }) => (
            <Fade {...TransitionProps}>
              <Paper>
                <List
                  sx={{
                    "& > .MuiListItem-root": {
                      px: 0,
                      py: 0,
                      display: "block",
                    },
                  }}
                >
                  {options.map(({ path, icon, text }, index) => (
                    <ListItem key={index}>
                      <Link onClick={() => setMenuOpen(false)} to={path}>
                        <ListItemButton>
                          <ListItemIcon>{icon}</ListItemIcon>
                          <ListItemText>{text}</ListItemText>
                        </ListItemButton>
                      </Link>
                    </ListItem>
                  ))}
                </List>
              </Paper>
            </Fade>
          )}
        </Popper>
      </Box>
    </ClickAwayListener>
  );
}
