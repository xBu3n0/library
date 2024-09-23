import { createContext } from "react";
import User from "../interfaces/user";

const AuthContext = createContext<User | null>(null);

export default AuthContext;
