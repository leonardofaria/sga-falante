# script ruby para gerar os arquivos de voz no mac os

('a'..'z').each do |n|
  system "say -o sounds/#{n}.aiff #{n}"
  puts n
end

(0...1000).each do |n|
  system "say -o sounds/#{n}.aiff #{n}"
  puts n
end