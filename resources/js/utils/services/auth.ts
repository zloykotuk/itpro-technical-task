import {baseService} from "./axios";
import {ModelRequest} from "../../pages/SignUp/interfaces/Model";

export const signUp = (model: ModelRequest) => {
    return baseService.post('/user/', model);
}
