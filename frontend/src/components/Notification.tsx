import { Notifications } from "@mui/icons-material";
import {
  Badge,
  Box,
  ClickAwayListener,
  Fade,
  IconButton,
  List,
  ListItem,
  ListItemText,
  Paper,
  Popper,
  Tooltip,
  Typography,
} from "@mui/material";
import { useCallback, useContext, useEffect, useRef, useState } from "react";
import api from "../axios/api";
import AuthContext from "../contexts/AuthContext";

interface NotificationMessage {
  id: string;
  data: {
    message: string;
  };
}

interface Notification {
  id: string;
  notification: {
    message: string;
  };
}

export default function Notification() {
  const auth = useContext(AuthContext);

  const [notifications, setNotifications] = useState<Notification[]>([]);
  const [notificationsOpen, setNotificationsOpen] = useState(false);

  const fetchNotifications = useCallback(async () => {
    const result = await api.get("/notifications");
    console.log(result.data);

    setNotifications(
      result.data.map((notification: NotificationMessage) => ({
        id: notification.id,
        notification: {
          message: notification.data.message,
        },
      })),
    );
  }, []);

  const notificationsRef = useRef(undefined);

  useEffect(() => {
    if (auth) {
      fetchNotifications();
    }
  }, [auth, fetchNotifications]);

  return (
    <>
      {auth && (
        <ClickAwayListener onClickAway={() => setNotificationsOpen(false)}>
          <Box ref={notificationsRef}>
            <Tooltip
              arrow
              disableInteractive
              title={
                <Typography fontSize="small">Toggle notifications</Typography>
              }
            >
              <IconButton onClick={() => setNotificationsOpen(true)}>
                <Badge badgeContent={notifications.length} color="info">
                  <Notifications />
                </Badge>
              </IconButton>
            </Tooltip>
            <Popper
              sx={{ zIndex: 1 }}
              anchorEl={notificationsRef.current}
              placement="bottom-end"
              open={notificationsOpen}
              transition
            >
              {({ TransitionProps }) => (
                <Fade {...TransitionProps}>
                  <Paper>
                    <List>
                      {notifications.map(
                        ({ notification: { message } }, index) => (
                          <ListItem key={index}>
                            <ListItemText>{message}</ListItemText>
                          </ListItem>
                        ),
                      )}
                    </List>
                  </Paper>
                </Fade>
              )}
            </Popper>
          </Box>
        </ClickAwayListener>
      )}
    </>
  );
}
