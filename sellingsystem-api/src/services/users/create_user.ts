import { IUsersRepository } from "../../interfaces/repositories/i_users_repository.ts";
import { CreateUserDTO } from "../../dto/create_user_dto.ts";
import bcrypt from "bcrypt";

export class CreateUserService {
  constructor(private usersRepository: IUsersRepository) {}

  async execute({ username, password, cpf, role }: CreateUserDTO) {

    const userExists = await this.usersRepository.findByUsername(username);

    if (userExists) {
      throw new Error("User already exists");
    }

    const hashedPassword = await bcrypt.hash(password, 10);

    const user = await this.usersRepository.create({
      username,
      password: hashedPassword,
      cpf,
      role
    });

    return user;
  }
}