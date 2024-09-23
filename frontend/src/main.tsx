import { StrictMode } from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";

import { createRoot } from "react-dom/client";
import App from "./App.tsx";

import "./index.css";
import NotFound from "./ErrorPages/NotFound.tsx";
import Layout from "./components/Layout.tsx";
import Cart from "./Pages/Cart/Cart.tsx";
import Register from "./Pages/Auth/Register.tsx";
import Login from "./Pages/Auth/Login.tsx";
import Logout from "./Pages/Auth/Logout.tsx";
import AuthProvider from "./components/AuthProvider.tsx";

createRoot(document.getElementById("root")!).render(
  <StrictMode>
    <BrowserRouter>
      <Routes>
        <Route
          path="/"
          element={
            <AuthProvider>
              <Layout />
            </AuthProvider>
          }
        >
          <Route index element={<App />} />
          <Route path="/register" element={<Register />} />
          <Route path="/login" element={<Login />} />
          <Route path="/logout" element={<Logout />} />
          <Route path="/cart" element={<Cart />} />
          <Route path="*" element={<NotFound />} />
        </Route>
      </Routes>
    </BrowserRouter>
  </StrictMode>,
);
