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

interface FormInterface {
  name: string;
  email: string;
  password: string;
}

export default function Register() {
  const [form, setForm] = useState<FormInterface>({
    name: "",
    email: "",
    password: "",
  });

  const handleSubmit = useCallback(
    async (e: FormEvent<HTMLFormElement>) => {
      e.preventDefault();
      console.log(form);

      const result = await api.post("http://[::1]:2000/api/register", form);

      console.log(result.data);
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
            Cadastro
          </Typography>
          <Box
            sx={{ display: "flex", flexDirection: "column", m: "auto", gap: 2 }}
          >
            <FormGroup>
              <TextField
                label="nome"
                type="text"
                value={form.name}
                onChange={(e) => setForm({ ...form, name: e.target.value })}
                required
              />
            </FormGroup>
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
            <Button type="submit">Cadastrar</Button>
          </Box>
        </Box>
      </Paper>
    </Container>
  );
}
