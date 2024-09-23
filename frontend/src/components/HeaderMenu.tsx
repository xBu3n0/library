import { Box, List, ListItem, Typography } from "@mui/material";
import { useContext } from "react";
import { Link } from "react-router-dom";
import AuthContext from "../contexts/AuthContext";

export default function HeaderMenu() {
  const auth = useContext(AuthContext);

  return (
    <Box>
      {auth && (
        <List sx={{ display: "flex", gap: 8 }}>
          <ListItem>
            <Link to={"/notAValidPage"}>
              <Typography>Not Found</Typography>
            </Link>
          </ListItem>
          <ListItem>
            <Link to={"/notAValidPage"}>
              <Typography>Not Found</Typography>
            </Link>
          </ListItem>
          <ListItem>
            <Link to={"/notAValidPage"}>
              <Typography>Not Found</Typography>
            </Link>
          </ListItem>
        </List>
      )}
    </Box>
  );
}
