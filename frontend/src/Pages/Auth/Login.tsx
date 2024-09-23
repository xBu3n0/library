import {
  Box,
  Button,
  Container,
  FormGroup,
  Paper,
  TextField,
  Typography,
} from "@mui/material";
import { FormEvent, useCallback, useState } from "react";
import api from "../../axios/api";
import { useNavigate } from "react-router-dom";

interface FormInterface {
  email: string;
  password: string;
}

export default function Login() {
  const navigate = useNavigate();

  const [form, setForm] = useState<FormInterface>({
    email: "",
    password: "",
  });

  const handleSubmit = useCallback(
    async (e: FormEvent<HTMLFormElement>) => {
      e.preventDefault();
      console.log(form);

      const result = await api.post("/login", {
        withCredentials: true,
        withXSRFToken: true,
        ...form,
      });

      if (result.data.auth === true) {
        navigate("/");
        window.location.reload();
      }
    },
    [form],
  );

  return (
    <Container>
      <Paper sx={{ mt: 8, p: 6, gap: 2 }} elevation={10}>
        <Box
          component="form"
          onSubmit={handleSubmit}
          sx={{
            pt: 8,
            gap: 2,
            display: "flex",
            flexDirection: "column",
          }}
        >
          <Typography
            component="h2"
            variant="h4"
            sx={{ display: "flex", justifyContent: "center", pb: 1 }}
          >
            Entrar
          </Typography>
          <Box
            sx={{ display: "flex", flexDirection: "column", m: "auto", gap: 2 }}
          >
            <FormGroup>
              <TextField
                label="email"
                type="text"
                value={form.email}
                onChange={(e) => setForm({ ...form, email: e.target.value })}
                required
              />
            </FormGroup>
            <FormGroup>
              <TextField
                label="password"
                type="password"
                value={form.password}
                onChange={(e) => setForm({ ...form, password: e.target.value })}
                required
              />
            </FormGroup>
            <Button type="submit">Entrar</Button>
          </Box>
        </Box>
      </Paper>
    </Container>
  );
}
