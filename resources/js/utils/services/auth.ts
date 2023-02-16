import {baseService} from "./axios";
import {SignUpRequest} from "../../interfaces/auth/signup";

export const signUp = (model: SignUpRequest) => {
    return baseService.post('/user/', model);
}
