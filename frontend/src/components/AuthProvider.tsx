import React, { useCallback, useEffect, useState } from "react";
import api from "../axios/api";
import AuthContext from "../contexts/AuthContext";
import User from "../interfaces/user";

export default function AuthProvider({
  children,
}: Readonly<{ children: React.ReactNode }>) {
  const [auth, setAuth] = useState<User | null>(null);

  const verifyLogged = useCallback(async () => {
    const auth = await api.get("/auth");

    setAuth(auth.data.user);
  }, []);

  useEffect(() => {
    verifyLogged();
  }, [verifyLogged]);

  return <AuthContext.Provider value={auth}>{children}</AuthContext.Provider>;
}
