import { useCallback, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../axios/api";

export default function Logout() {
  const navigate = useNavigate();

  const logout = useCallback(async () => {
    await api.post("/logout");

    navigate("/", { unstable_flushSync: true });
    window.location.reload();
  }, [navigate]);

  useEffect(() => {
    logout();
  });

  return <></>;
}
